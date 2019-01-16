<?php 

namespace backend\models;
use yii\helpers\ArrayHelper;
use Yii;
use backend\models\Book;
use backend\models\BookAuthor;
/**
 * 
 */
class BookWithAuthor extends Book
{
    /**
     * @var array IDs of the categories
     */
    public $author_ids = [];
    
    /**
     * @return array the validation rules.
     */
	public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // each author_id must exist in author table (*1)
            ['author_ids', 'each', 'rule' => [
                    'exist', 'targetClass' => Author::className(), 'targetAttribute' => 'author_id'
                ]
            ],
        ]);
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'author_ids' => 'Các tác giả',
        ]);
    }

    /**
     * load the book's authors (*2)
     */
    public function loadAuthors()
    {
        $this->author_ids = [];
        // if (!empty($this->author_id)) {
            $rows = BookAuthor::find()
                ->select(['author_id'])
                ->where(['book_id' => $this->book_id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->author_ids[] = $row['author_id'];
            }
        // }
    }

    /**
     * save the book's authors (*3)
     */
    public function saveAuthors()
    {
        /* clear the authors of the book before saving */
       BookAuthor::deleteAll(['book_id' => $this->book_id]);
        if (is_array($this->author_ids)) {
        
            foreach($this->author_ids as $author_id) {
                $bu = new BookAuthor();
                $bu->book_id = $this->book_id;
                $bu->author_id = $author_id;
                $bu->save();
            }
          }
        
        /* Be careful, $this->author_ids can be empty */
    }
}

 ?>