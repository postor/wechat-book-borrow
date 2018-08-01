<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\BorrowOperation;
use common\models\BorrowWxuserBook;
use \yii\helpers\Url;
use common\models\WxUser;
use yii\web\HttpException;

class BorrowController extends \yii\web\Controller
{
    const WX_OPENID_SESSION_NAME = 'wx_openid';
    const WX_TOKEN_SESSION_NAME = 'wx_token';

    public function actionIndex($id = false, $code = false, $state = false)
    {
        $wechat = \Yii::$app->wechat;
        $session = \Yii::$app->session;
        $session->open();
        $openId = $session->get(self::WX_OPENID_SESSION_NAME);
        $token = $session->get(self::WX_TOKEN_SESSION_NAME);
        if ($openId && $id && $token) {
            if ($wechat->checkOauth2AccessToken($token, $openId)) {
                $request = \Yii::$app->request;
                if ($request->isPost) {
                    $data = $request->post();
                    $operation = BorrowOperation::performOperation($data['operation'], $data['user_id'], $data['book_id'], $openId);
                    return $this->render('message',['message'=>"[$operation->title]操作成功！"]);
                }
                return $this->renderIndex($openId, $id);
            }
            return 'checkOauth2AccessToken 失败';
        }

        if ($code && $state) {
            $result = $wechat->getOauth2AccessToken($code);
            if ($result) {
                $session->set(self::WX_OPENID_SESSION_NAME, $result['openid']);
                $session->set(self::WX_TOKEN_SESSION_NAME, $result['access_token']);
                return $this->renderIndex($result['openid'], $state);
            }
            return $this->render('message',['message'=>'授权失败']);
        }

        $url = $wechat->getOauth2AuthorizeUrl(Url::to(['/borrow'], true), $id);
        $this->redirect($url);
    }

    private function renderIndex($openId, $bookId)
    {
        $user = WxUser::findOne(['uuid' => $openId]);
        if (!$user) {
            $user = new WxUser();
            $user->uuid = $openId;
            $user->save(false);
        }

        $book = Book::findOne(['id' => $bookId]);
        if (!$book) {
            throw new HttpException(502, 'book of id:' . $bookId . ' not found!');
        }

        $operation = BorrowOperation::getOperation($user, $book);

        return $this->render('index', [
            'openid' => $openId,
            'bookid' => $bookId,
            'user' => $user,
            'book' => $book,
            'operation' => $operation,
        ]);
    }


}
