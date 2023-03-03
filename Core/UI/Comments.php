<?php

namespace UI;

use Datainterface\Database;
use Datainterface\Delete;
use Datainterface\Insertion;
use Datainterface\MysqlDynamicTables;
use Datainterface\Query;
use Datainterface\Selection;
use Datainterface\Tables;
use Datainterface\Updating;


class Comments
{
  public static function commentInit(){

      $usersTable = Tables::tablesExists(['users']);
      if(empty($usersTable)){
          throw new \Exception('Comment Class requested without users table presence in db');
      }
      self::createTable();

  }
  public static function commentSchema(){
      $columns = ['cid','comment_body','commentor_uid','post_id','comment_title'];
      $attribute = [
        'cid'=>['int(11)','auto_increment','primary key'],
        'comment_body'=>['text','not null'],
        'commentor_uid'=>['int(11)','not null'],
        'post_id'=>['int(11)','not null'],
        'comment_title'=>['varchar(100)','null']
      ];
      return ['col'=>$columns, 'att'=>$attribute,'table'=>'comments'];
  }

  public static function createTable(){
      $table = self::commentSchema();
      $maker = new MysqlDynamicTables();
      $maker->resolver(Database::database(),$table['col'],$table['att'],$table['table'],false);
      $maker->resolver(Database::database(),self::replySchema()['col'],self::replySchema()['att'],self::replySchema()['table'],false);
  }

  public static function saveNewComment($commentData){
      if(!empty($commentData)){
          $schm = self::commentSchema();
          return Insertion::insertRow($schm['table'], $commentData);
      }
  }

  public static function updateComment($cid, $data){
      if(!empty($cid)){
          return Updating::update(self::commentSchema()['table'],$data,['cid'=>$cid]);
      }
  }

  public static function deleteComment($cid){
      return Delete::delete(self::commentSchema()['table'],['cid'=>$cid]);
  }

  public static function loadAllCommentByPostId($postid){
      return Selection::selectById(self::commentSchema()['table'],['post_id'=>$postid]);
  }

  public static function replySchema(){
      $columns = ['rid','reply_body','cid','reply_title','post_id'];
      $attributes =[
        'rid'=>['int(11)','auto_increment','primary key'],
        'reply_body'=>['text','null'],
        'cid'=>['int(11)','not null'],
        'reply_title'=>['varchar(100)','null'],
        'post_id'=>['int(11)','not null']
      ];
      return ['col'=>$columns,'att'=>$attributes,'table'=>'replies_table'];
  }

  public static function saveNewReply($replay){
      if(!empty($replay)){
          return Insertion::insertRow(self::replySchema()['table'],$replay);
      }
  }

  public static function updateReply($rid, $data){
      if(!empty($cid) && !empty($data)){
          return Updating::update(self::replySchema()['table'],$data,['rid'=>$rid]);
      }
  }

  public static function deleteReply($rid){
      return Delete::delete(self::replySchema()['table'],['rid'=>$rid]);
  }

  public static function loadAllRepliesByCommentId($cid){
      return Selection::selectById(self::replySchema()['table'],['cid'=>$cid]);
  }

  public static function loadAllCommentAndRepliesByCommentId($cid){
      $table = self::commentSchema()['table'];
      $table2 = self::replySchema()['table'];
      $query = "SELECT * FROM {$table} AS coms LEFT JOIN {$table2} AS rps ON coms.cid = rps.cid WHERE coms.cid = :id";
      return Query::query($query,['id'=>$cid]);
  }

  public static function loadAllCommentsAndRepliesByPostId($postId){
      $table = self::commentSchema()['table'];
      $table2 = self::replySchema()['table'];
      $query = "SELECT * FROM {$table} AS coms LEFT JOIN {$table2} AS rps ON coms.cid = rps.cid WHERE coms.post_id = :id";
      return Query::query($query,['id'=>$postId]);
  }

  public static function deleteAllCommentByPostId($postid){
      Delete::delete(self::commentSchema()['table'],['post_id'=>$postid]);
      return Delete::delete(self::replySchema()['table'],['post_id'=>$postid]);
  }
}