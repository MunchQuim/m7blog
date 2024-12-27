<?php
namespace controllers;
use models\User;
use models\Chat;
use models\Message;
use PDO;

class ChatController
{

    private $userModel;

    private $chatModel;
    private $messageModel;

    public function __construct(User $user, Chat $chat,Message $message)
    {
        $this->userModel = $user;
        $this->chatModel = $chat;
        $this->messageModel = $message;
    }

    public function handleCreateMessage($user_id, $receptor_id, $message)
    {
     if(!$this->chatExists($user_id, $receptor_id)){
        $this->chatModel->user1_id = $user_id;
        $this->chatModel->user2_id = $receptor_id;
        $this->chatModel->create();
     }  
        $this->messageModel->chat_user1_id = $user_id;
        $this->messageModel->chat_user2_id = $receptor_id;
        $this->messageModel->message = $message;
        $this->messageModel->create();
    }
    public function chatExists($user_id,$receptor_id){
        $this->chatModel->user1_id = $user_id;
        $this->chatModel->user2_id = $receptor_id;
        
        $stmt = $this->chatModel->readById();
        $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($chats){
            return true;
        }
        else{
            return false;
        }
    }
    
}