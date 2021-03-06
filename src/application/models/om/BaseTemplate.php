<?php


/**
 * Base class that represents a row from the 'template' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseTemplate extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TemplatePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TemplatePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the layout field.
     * @var        string
     */
    protected $layout;

    /**
     * @var        PropelObjectCollection|Screen[] Collection to store aggregation of Screen objects.
     */
    protected $collScreens;
    protected $collScreensPartial;

    /**
     * @var        PropelObjectCollection|TemplateWidget[] Collection to store aggregation of TemplateWidget objects.
     */
    protected $collTemplateWidgets;
    protected $collTemplateWidgetsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $screensScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templateWidgetsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [layout] column value.
     *
     * @return string
     */
    public function getLayout()
    {

        return $this->layout;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Template The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TemplatePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Template The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = TemplatePeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [layout] column.
     *
     * @param  string $v new value
     * @return Template The current object (for fluent API support)
     */
    public function setLayout($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->layout !== $v) {
            $this->layout = $v;
            $this->modifiedColumns[] = TemplatePeer::LAYOUT;
        }


        return $this;
    } // setLayout()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->layout = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 3; // 3 = TemplatePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Template object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TemplatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TemplatePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collScreens = null;

            $this->collTemplateWidgets = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TemplatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TemplateQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TemplatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TemplatePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->screensScheduledForDeletion !== null) {
                if (!$this->screensScheduledForDeletion->isEmpty()) {
                    ScreenQuery::create()
                        ->filterByPrimaryKeys($this->screensScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->screensScheduledForDeletion = null;
                }
            }

            if ($this->collScreens !== null) {
                foreach ($this->collScreens as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templateWidgetsScheduledForDeletion !== null) {
                if (!$this->templateWidgetsScheduledForDeletion->isEmpty()) {
                    TemplateWidgetQuery::create()
                        ->filterByPrimaryKeys($this->templateWidgetsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->templateWidgetsScheduledForDeletion = null;
                }
            }

            if ($this->collTemplateWidgets !== null) {
                foreach ($this->collTemplateWidgets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = TemplatePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TemplatePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TemplatePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TemplatePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(TemplatePeer::LAYOUT)) {
            $modifiedColumns[':p' . $index++]  = '`layout`';
        }

        $sql = sprintf(
            'INSERT INTO `template` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`layout`':
                        $stmt->bindValue($identifier, $this->layout, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = TemplatePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collScreens !== null) {
                    foreach ($this->collScreens as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplateWidgets !== null) {
                    foreach ($this->collTemplateWidgets as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getLayout();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Template'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Template'][$this->getPrimaryKey()] = true;
        $keys = TemplatePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getLayout(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collScreens) {
                $result['Screens'] = $this->collScreens->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplateWidgets) {
                $result['TemplateWidgets'] = $this->collTemplateWidgets->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setLayout($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = TemplatePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLayout($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TemplatePeer::DATABASE_NAME);

        if ($this->isColumnModified(TemplatePeer::ID)) $criteria->add(TemplatePeer::ID, $this->id);
        if ($this->isColumnModified(TemplatePeer::NAME)) $criteria->add(TemplatePeer::NAME, $this->name);
        if ($this->isColumnModified(TemplatePeer::LAYOUT)) $criteria->add(TemplatePeer::LAYOUT, $this->layout);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(TemplatePeer::DATABASE_NAME);
        $criteria->add(TemplatePeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Template (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setLayout($this->getLayout());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getScreens() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addScreen($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplateWidgets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateWidget($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Template Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return TemplatePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TemplatePeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Screen' == $relationName) {
            $this->initScreens();
        }
        if ('TemplateWidget' == $relationName) {
            $this->initTemplateWidgets();
        }
    }

    /**
     * Clears out the collScreens collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Template The current object (for fluent API support)
     * @see        addScreens()
     */
    public function clearScreens()
    {
        $this->collScreens = null; // important to set this to null since that means it is uninitialized
        $this->collScreensPartial = null;

        return $this;
    }

    /**
     * reset is the collScreens collection loaded partially
     *
     * @return void
     */
    public function resetPartialScreens($v = true)
    {
        $this->collScreensPartial = $v;
    }

    /**
     * Initializes the collScreens collection.
     *
     * By default this just sets the collScreens collection to an empty array (like clearcollScreens());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initScreens($overrideExisting = true)
    {
        if (null !== $this->collScreens && !$overrideExisting) {
            return;
        }
        $this->collScreens = new PropelObjectCollection();
        $this->collScreens->setModel('Screen');
    }

    /**
     * Gets an array of Screen objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Template is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Screen[] List of Screen objects
     * @throws PropelException
     */
    public function getScreens($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collScreensPartial && !$this->isNew();
        if (null === $this->collScreens || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collScreens) {
                // return empty collection
                $this->initScreens();
            } else {
                $collScreens = ScreenQuery::create(null, $criteria)
                    ->filterByTemplate($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collScreensPartial && count($collScreens)) {
                      $this->initScreens(false);

                      foreach ($collScreens as $obj) {
                        if (false == $this->collScreens->contains($obj)) {
                          $this->collScreens->append($obj);
                        }
                      }

                      $this->collScreensPartial = true;
                    }

                    $collScreens->getInternalIterator()->rewind();

                    return $collScreens;
                }

                if ($partial && $this->collScreens) {
                    foreach ($this->collScreens as $obj) {
                        if ($obj->isNew()) {
                            $collScreens[] = $obj;
                        }
                    }
                }

                $this->collScreens = $collScreens;
                $this->collScreensPartial = false;
            }
        }

        return $this->collScreens;
    }

    /**
     * Sets a collection of Screen objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $screens A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Template The current object (for fluent API support)
     */
    public function setScreens(PropelCollection $screens, PropelPDO $con = null)
    {
        $screensToDelete = $this->getScreens(new Criteria(), $con)->diff($screens);


        $this->screensScheduledForDeletion = $screensToDelete;

        foreach ($screensToDelete as $screenRemoved) {
            $screenRemoved->setTemplate(null);
        }

        $this->collScreens = null;
        foreach ($screens as $screen) {
            $this->addScreen($screen);
        }

        $this->collScreens = $screens;
        $this->collScreensPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Screen objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Screen objects.
     * @throws PropelException
     */
    public function countScreens(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collScreensPartial && !$this->isNew();
        if (null === $this->collScreens || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collScreens) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getScreens());
            }
            $query = ScreenQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTemplate($this)
                ->count($con);
        }

        return count($this->collScreens);
    }

    /**
     * Method called to associate a Screen object to this object
     * through the Screen foreign key attribute.
     *
     * @param    Screen $l Screen
     * @return Template The current object (for fluent API support)
     */
    public function addScreen(Screen $l)
    {
        if ($this->collScreens === null) {
            $this->initScreens();
            $this->collScreensPartial = true;
        }

        if (!in_array($l, $this->collScreens->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddScreen($l);

            if ($this->screensScheduledForDeletion and $this->screensScheduledForDeletion->contains($l)) {
                $this->screensScheduledForDeletion->remove($this->screensScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Screen $screen The screen object to add.
     */
    protected function doAddScreen($screen)
    {
        $this->collScreens[]= $screen;
        $screen->setTemplate($this);
    }

    /**
     * @param	Screen $screen The screen object to remove.
     * @return Template The current object (for fluent API support)
     */
    public function removeScreen($screen)
    {
        if ($this->getScreens()->contains($screen)) {
            $this->collScreens->remove($this->collScreens->search($screen));
            if (null === $this->screensScheduledForDeletion) {
                $this->screensScheduledForDeletion = clone $this->collScreens;
                $this->screensScheduledForDeletion->clear();
            }
            $this->screensScheduledForDeletion[]= clone $screen;
            $screen->setTemplate(null);
        }

        return $this;
    }

    /**
     * Clears out the collTemplateWidgets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Template The current object (for fluent API support)
     * @see        addTemplateWidgets()
     */
    public function clearTemplateWidgets()
    {
        $this->collTemplateWidgets = null; // important to set this to null since that means it is uninitialized
        $this->collTemplateWidgetsPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplateWidgets collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplateWidgets($v = true)
    {
        $this->collTemplateWidgetsPartial = $v;
    }

    /**
     * Initializes the collTemplateWidgets collection.
     *
     * By default this just sets the collTemplateWidgets collection to an empty array (like clearcollTemplateWidgets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplateWidgets($overrideExisting = true)
    {
        if (null !== $this->collTemplateWidgets && !$overrideExisting) {
            return;
        }
        $this->collTemplateWidgets = new PropelObjectCollection();
        $this->collTemplateWidgets->setModel('TemplateWidget');
    }

    /**
     * Gets an array of TemplateWidget objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Template is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TemplateWidget[] List of TemplateWidget objects
     * @throws PropelException
     */
    public function getTemplateWidgets($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplateWidgetsPartial && !$this->isNew();
        if (null === $this->collTemplateWidgets || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplateWidgets) {
                // return empty collection
                $this->initTemplateWidgets();
            } else {
                $collTemplateWidgets = TemplateWidgetQuery::create(null, $criteria)
                    ->filterByTemplate($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplateWidgetsPartial && count($collTemplateWidgets)) {
                      $this->initTemplateWidgets(false);

                      foreach ($collTemplateWidgets as $obj) {
                        if (false == $this->collTemplateWidgets->contains($obj)) {
                          $this->collTemplateWidgets->append($obj);
                        }
                      }

                      $this->collTemplateWidgetsPartial = true;
                    }

                    $collTemplateWidgets->getInternalIterator()->rewind();

                    return $collTemplateWidgets;
                }

                if ($partial && $this->collTemplateWidgets) {
                    foreach ($this->collTemplateWidgets as $obj) {
                        if ($obj->isNew()) {
                            $collTemplateWidgets[] = $obj;
                        }
                    }
                }

                $this->collTemplateWidgets = $collTemplateWidgets;
                $this->collTemplateWidgetsPartial = false;
            }
        }

        return $this->collTemplateWidgets;
    }

    /**
     * Sets a collection of TemplateWidget objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templateWidgets A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Template The current object (for fluent API support)
     */
    public function setTemplateWidgets(PropelCollection $templateWidgets, PropelPDO $con = null)
    {
        $templateWidgetsToDelete = $this->getTemplateWidgets(new Criteria(), $con)->diff($templateWidgets);


        $this->templateWidgetsScheduledForDeletion = $templateWidgetsToDelete;

        foreach ($templateWidgetsToDelete as $templateWidgetRemoved) {
            $templateWidgetRemoved->setTemplate(null);
        }

        $this->collTemplateWidgets = null;
        foreach ($templateWidgets as $templateWidget) {
            $this->addTemplateWidget($templateWidget);
        }

        $this->collTemplateWidgets = $templateWidgets;
        $this->collTemplateWidgetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TemplateWidget objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TemplateWidget objects.
     * @throws PropelException
     */
    public function countTemplateWidgets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplateWidgetsPartial && !$this->isNew();
        if (null === $this->collTemplateWidgets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplateWidgets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplateWidgets());
            }
            $query = TemplateWidgetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTemplate($this)
                ->count($con);
        }

        return count($this->collTemplateWidgets);
    }

    /**
     * Method called to associate a TemplateWidget object to this object
     * through the TemplateWidget foreign key attribute.
     *
     * @param    TemplateWidget $l TemplateWidget
     * @return Template The current object (for fluent API support)
     */
    public function addTemplateWidget(TemplateWidget $l)
    {
        if ($this->collTemplateWidgets === null) {
            $this->initTemplateWidgets();
            $this->collTemplateWidgetsPartial = true;
        }

        if (!in_array($l, $this->collTemplateWidgets->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateWidget($l);

            if ($this->templateWidgetsScheduledForDeletion and $this->templateWidgetsScheduledForDeletion->contains($l)) {
                $this->templateWidgetsScheduledForDeletion->remove($this->templateWidgetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateWidget $templateWidget The templateWidget object to add.
     */
    protected function doAddTemplateWidget($templateWidget)
    {
        $this->collTemplateWidgets[]= $templateWidget;
        $templateWidget->setTemplate($this);
    }

    /**
     * @param	TemplateWidget $templateWidget The templateWidget object to remove.
     * @return Template The current object (for fluent API support)
     */
    public function removeTemplateWidget($templateWidget)
    {
        if ($this->getTemplateWidgets()->contains($templateWidget)) {
            $this->collTemplateWidgets->remove($this->collTemplateWidgets->search($templateWidget));
            if (null === $this->templateWidgetsScheduledForDeletion) {
                $this->templateWidgetsScheduledForDeletion = clone $this->collTemplateWidgets;
                $this->templateWidgetsScheduledForDeletion->clear();
            }
            $this->templateWidgetsScheduledForDeletion[]= $templateWidget;
            $templateWidget->setTemplate(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Template is new, it will return
     * an empty collection; or if this Template has previously
     * been saved, it will retrieve related TemplateWidgets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Template.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateWidget[] List of TemplateWidget objects
     */
    public function getTemplateWidgetsJoinWidget($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateWidgetQuery::create(null, $criteria);
        $query->joinWith('Widget', $join_behavior);

        return $this->getTemplateWidgets($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->layout = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collScreens) {
                foreach ($this->collScreens as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplateWidgets) {
                foreach ($this->collTemplateWidgets as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collScreens instanceof PropelCollection) {
            $this->collScreens->clearIterator();
        }
        $this->collScreens = null;
        if ($this->collTemplateWidgets instanceof PropelCollection) {
            $this->collTemplateWidgets->clearIterator();
        }
        $this->collTemplateWidgets = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TemplatePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
