<?php
/**
 * Created by PhpStorm.
 * User: R720
 * Date: 2018/8/1
 * Time: 9:15
 */

namespace common\models;

use yii\base\Exception;

class BorrowOperation
{
    const OPERATION_BORROW = 'borrow';
    const OPERATION_REBORROW = 'reborrow';
    const OPERATION_RETURN = 'return';
    const OPERATION_NONE = 'none';

    public static $OPERATION_TITLE_MAP = [
        self::OPERATION_BORROW => '借阅',
        self::OPERATION_REBORROW => '续借',
        self::OPERATION_RETURN => '归还',
        self::OPERATION_NONE => '',
    ];

    public $message = '';
    public $operation = '';
    public $title = '';

    public function __construct($operation, $message)
    {
        $this->operation = $operation;
        $this->message = $message;
        $this->title = self::$OPERATION_TITLE_MAP[$operation];
    }

    /**
     * @param $book Book
     */
    static function getOperation($user, $book)
    {
        //其他人扫码表示借书
        $borrows = $book->getBorrows()
            ->orderBy('borrow_time desc')
            ->limit(2)
            ->all();

        $count = count($borrows);

        if ($book->borrowed) {
            //管理员扫码表示归还
            if ($user->is_admin) {
                return new BorrowOperation(self::OPERATION_RETURN, '管理员扫码还书');
            }

            //连续借2次
            if ($count == 2 && $borrows[0]->wxuser_id == $user->id && $borrows[1]->wxuser_id == $user->id) {
                return new BorrowOperation(self::OPERATION_NONE, '无法续借，已经连续借阅此书2次');
            }

            //连续借1次
            if ($count >= 1) {
                if ($borrows[0]->wxuser_id == $user->id) {
                    return new BorrowOperation(self::OPERATION_REBORROW, '用户扫码续借');
                }
            }

            //其他
            return new BorrowOperation(self::OPERATION_BORROW, '用户扫码借书，操作后原借书用户将视为归还');
        }

        // !$book->borrowed 图书没有借出
        //没有人借过 或上一次不是此人借的
        if (!$count || $borrows[0]->wxuser_id != $user->id) {
            return new BorrowOperation(self::OPERATION_BORROW, '用户扫码借书');
        }

        //上一次是此人借的但上上次不是
        if ($count == 1 || $borrows[1]->wxuser_id != $user->id) {
            return new BorrowOperation(self::OPERATION_REBORROW, '用户扫码续借');
        }

        //其他情况
        return new BorrowOperation(self::OPERATION_NONE, '您已经连续借此书2次，不能再续借此书了');
    }

    public static function performOperation($operation, $bookId, $wxuserId, $openId)
    {
        $user = WxUser::findOne(['id' => $wxuserId]);
        $book = Book::findOne(['id' => $bookId]);

        if (!$user) {
            throw new Exception('用户[ID:' . $wxuserId . ']没找到!');
        }

        if (!$book) {
            throw new Exception('图书[ID:' . $bookId . ']没找到!');
        }

        if ($openId != $user->uuid) {
            throw new Exception('用户[openid:' . $openId . ']尝试假扮' . $user->uuid . '!');
        }

        $newOpt = self::getOperation($user, $book);
        if ($newOpt->operation != $operation) {
            throw new Exception('操作[' . $operation . ']已经过期，新的可用操作:' . $newOpt->operation);
        }

        switch ($operation) {
            case self::OPERATION_BORROW:
            case self::OPERATION_REBORROW:
                $borrow = $book->currentBorrow;
                if ($borrow) {
                    $borrow->return_time = date('Y-m-d H:i:s');
                    $borrow->save(false);
                }
                $newBorrow = new BorrowWxuserBook();
                $newBorrow->wxuser_id = $user->id;
                $newBorrow->book_id = $book->id;
                $newBorrow->borrow_time = date('Y-m-d H:i:s');
                $newBorrow->save(false);

                $book->borrowed = $newBorrow->id;
                $book->save(false);
                break;
            case self::OPERATION_RETURN:
                $book->borrowed = 0;
                $book->save(false);
                break;
            default:
                throw new Exception('操作[' . $operation . ']不是一个有效的操作');
        }
        return $newOpt;
    }

    public static function canReborrow($user, $book)
    {
        $operation = self::getOperation($user, $book);
        return $operation->operation == self::OPERATION_REBORROW;
    }
}