<?php
//namespace web_max\ecrivain;

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Manager.php');

class ChaptersManager {

  private $_db; // Instance de PDO.

  public function __construct(PDO $db){
    $this->setDb($db);
	require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Chapters.php');
		
  }

  public function add(Chapter $chapter)  {
    $q = $this->_db->prepare('INSERT INTO chapters(title, resume, content,chapter_date) VALUES(:title, :resume, :content, :chapter_date)');

    $q->bindValue(':title', $chapter->title());
    $q->bindValue(':resume', $chapter->resume(), PDO::PARAM_INT);
    $q->bindValue(':content', $chapter->content(), PDO::PARAM_INT);
    $q->bindValue(':chapter_date', $chapter->chapter_date(), PDO::PARAM_INT);

    $q->execute();
  }

  public function delete(Chapter $chapter)  {
    $this->_db->exec('DELETE FROM chapters WHERE idchapters = '.$chapter->idchapters());
  }

  private function get($chapter)  {
    $idchapters = (int) $idchapters;

    $q = $this->_db->query('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr FROM chapters WHERE idchapters = '.$idchapters);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Chapter($donnees);
  }


  public function getList()  {
    $chapters = [];

    $q = $this->_db->query('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr FROM chapters ORDER BY chapter_date ASC');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $chapters[] = new Chapter($donnees);
    }

    return $chapters;
  }

  public function update(Chapter $chapter)  {
   $q = $this->_db->prepare('UPDATE chapters SET title = :title, resume = :resume, content = :content, date_fr = :date_fr WHERE idchapters = :idchapters');

    $q->bindValue(':title', $chapter->title(), PDO::PARAM_INT);
    $q->bindValue(':resume', $chapter->resume(), PDO::PARAM_INT);
    $q->bindValue(':content', $chapter->content(), PDO::PARAM_INT);
    $q->bindValue(':date_fr', $chapter->date_fr(), PDO::PARAM_INT);
    $q->bindValue(':idchapters', $chapter->idchapters(), PDO::PARAM_INT);

    $q->execute();

  }

  private function setDb(PDO $db)
  {
	//$this->_db = new web_max\ecrivain\PDO('mysql:host=localhost;dbname=ecrivain;charset=utf8', 'root', '');
    $this->_db = $db;
  }
 
}