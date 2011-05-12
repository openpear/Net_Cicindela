<?php
ini_set("include_path", realpath(dirname(__FILE__) . "/../../../../src").PATH_SEPARATOR.ini_get("include_path"));
require_once 'PHPUnit/Framework.php';

require_once 'Net/Cicindela/Dataset.php';

/**
 * Test class for Net_Cicindela_Dataset.
 * Generated by PHPUnit on 2009-06-11 at 11:10:41.
 */
class Net_Cicindela_DatasetTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Net_Cicindela_Dataset
     * @access protected
     */
    protected $object;

    /**
     *
     * @var Net_Cicindela 
     */
    protected $cicindelaStab;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $this->cicindelaStab = $this->getMock('Net_Cicindela');
        $this->object = new Net_Cicindela_Dataset('test', $this->cicindelaStab);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown()
    {
    }

    /**
     * 
     */
    public function testPickItem() {
        $user_id = 'foo';
        $item_id = 'bar';
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'op'=>'insert_pick', 'set'=>'test')));
        $this->object->pickItem($user_id, $item_id);
    }

    /**
     *
     */
    public function testVote() {
        $user_id = 'foo';
        $item_id = 'bar';
        $rating = 5;
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'rating'=>$rating, 'op'=>'insert_rating', 'set'=>'test')));
        $this->object->vote($user_id, $item_id, $rating);
    }

    /**
     * 
     */
    public function testTag() {
        $user_id = 'foo';
        $item_id = 'bar';
        $tag_id = 'hoge';
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'tag_id'=>$tag_id, 'op'=>'insert_tag', 'set'=>'test')));
        $this->object->tag($user_id, $item_id, $tag_id);
    }

    /**
     * 
     */
    public function testSetCategory() {
        $item_id = 'bar';
        $category_id = 4;
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('item_id'=>$item_id, 'category_id'=>$category_id, 'op'=>'set_category', 'set'=>'test')));

        $this->object->setCategory($item_id, $category_id);
    }

    /**
     * 
     */
    public function testUnpickItem() {
        $user_id = 'foo';
        $item_id = 'bar';
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'op'=>'delete_pick', 'set'=>'test')));
        $this->object->unpickItem($user_id, $item_id);
    }

    /**
     * 
     */
    public function testUnvote() {
        $user_id = 'foo';
        $item_id = 'bar';
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'op'=>'delete_rating', 'set'=>'test')));
        $this->object->unvote($user_id, $item_id);
    }

    /**
     * 
     */
    public function testUntag() {
        $user_id = 'foo';
        $item_id = 'bar';
        $tag_id = 'hoge';
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('user_id'=>$user_id, 'item_id'=>$item_id, 'tag_id'=>$tag_id, 'op'=>'delete_tag', 'set'=>'test')));
        $this->object->untag($user_id, $item_id, $tag_id);
    }

    /**
     * 
     */
    public function testRemoveCategory() {
        $item_id = 'bar';
        $category_id = 4;
        $this->cicindelaStab->expects($this->once())
            ->method('record')
            ->with($this->equalTo(array('item_id'=>$item_id, 'category_id'=>$category_id, 'op'=>'remove_category', 'set'=>'test')));

        $this->object->removeCategory($item_id, $category_id);
    }

    /**
     * 
     */
    public function testGetRecommendForItem() {
        $item_id = 'bar';
        $recommend = array('11111','22222','33333');
        $this->cicindelaStab->expects($this->once())
            ->method('getRecommend')
            ->with(array('item_id'=>$item_id, 'limit'=>10,'op'=>'for_item', 'set'=>'test'))
            ->will($this->returnValue($recommend));

       $this->assertEquals($recommend, $this->object->getRecommendForItem($item_id));
    }

    /**
     * @todo Implement testGetRecmmendForUser().
     */
    public function testGetRecommendForUser() {
        $user_id = 'bar';
        $recommend = array('11111','22222','33333');
        $this->cicindelaStab->expects($this->once())
            ->method('getRecommend')
            ->with(array('user_id'=>$user_id, 'limit'=>20,'op'=>'for_user', 'set'=>'test'))
            ->will($this->returnValue($recommend));

       $this->assertEquals($recommend, $this->object->getRecommendForUser($user_id));
    }

    /**
     * @todo Implement testGetSimilarUsers().
     */
    public function testGetSimilarUsers() {
        $user_id = 'bar';
        $recommend = array('11111','22222','33333');
        $this->cicindelaStab->expects($this->once())
            ->method('getRecommend')
            ->with(array('user_id'=>$user_id, 'limit'=>20,'op'=>'similar_users', 'set'=>'test'))
            ->will($this->returnValue($recommend));

       $this->assertEquals($recommend, $this->object->getSimilarUsers($user_id));
    }
}
?>
