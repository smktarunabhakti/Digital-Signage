<?php



/**
 * This class defines the structure of the 'image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class ImageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ImageTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('image');
        $this->setPhpName('Image');
        $this->setClassname('Image');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('filename', 'Filename', 'VARCHAR', true, 100, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'user', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('SlideshowImage', 'SlideshowImage', RelationMap::ONE_TO_MANY, array('id' => 'image_id', ), 'CASCADE', null, 'SlideshowImages');
        $this->addRelation('Slideshow', 'Slideshow', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Slideshows');
    } // buildRelations()

} // ImageTableMap
