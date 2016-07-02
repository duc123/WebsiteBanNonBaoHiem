<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Danhmuc as ChildDanhmuc;
use Model\DanhmucQuery as ChildDanhmucQuery;
use Model\Loaisp as ChildLoaisp;
use Model\LoaispQuery as ChildLoaispQuery;
use Model\Sanpham as ChildSanpham;
use Model\SanphamQuery as ChildSanphamQuery;
use Model\Map\LoaispTableMap;
use Model\Map\SanphamTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'LoaiSP' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Loaisp implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\LoaispTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the maloaisp field.
     *
     * @var        int
     */
    protected $maloaisp;

    /**
     * The value for the tenloaisp field.
     *
     * @var        string
     */
    protected $tenloaisp;

    /**
     * The value for the danhmuc_madm field.
     *
     * @var        int
     */
    protected $danhmuc_madm;

    /**
     * @var        ChildDanhmuc
     */
    protected $aDanhmuc;

    /**
     * @var        ObjectCollection|ChildSanpham[] Collection to store aggregation of ChildSanpham objects.
     */
    protected $collSanphams;
    protected $collSanphamsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSanpham[]
     */
    protected $sanphamsScheduledForDeletion = null;

    /**
     * Initializes internal state of Model\Base\Loaisp object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Loaisp</code> instance.  If
     * <code>obj</code> is an instance of <code>Loaisp</code>, delegates to
     * <code>equals(Loaisp)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Loaisp The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [maloaisp] column value.
     *
     * @return int
     */
    public function getMaloaisp()
    {
        return $this->maloaisp;
    }

    /**
     * Get the [tenloaisp] column value.
     *
     * @return string
     */
    public function getTenloaisp()
    {
        return $this->tenloaisp;
    }

    /**
     * Get the [danhmuc_madm] column value.
     *
     * @return int
     */
    public function getDanhmucMadm()
    {
        return $this->danhmuc_madm;
    }

    /**
     * Set the value of [maloaisp] column.
     *
     * @param int $v new value
     * @return $this|\Model\Loaisp The current object (for fluent API support)
     */
    public function setMaloaisp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->maloaisp !== $v) {
            $this->maloaisp = $v;
            $this->modifiedColumns[LoaispTableMap::COL_MALOAISP] = true;
        }

        return $this;
    } // setMaloaisp()

    /**
     * Set the value of [tenloaisp] column.
     *
     * @param string $v new value
     * @return $this|\Model\Loaisp The current object (for fluent API support)
     */
    public function setTenloaisp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tenloaisp !== $v) {
            $this->tenloaisp = $v;
            $this->modifiedColumns[LoaispTableMap::COL_TENLOAISP] = true;
        }

        return $this;
    } // setTenloaisp()

    /**
     * Set the value of [danhmuc_madm] column.
     *
     * @param int $v new value
     * @return $this|\Model\Loaisp The current object (for fluent API support)
     */
    public function setDanhmucMadm($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->danhmuc_madm !== $v) {
            $this->danhmuc_madm = $v;
            $this->modifiedColumns[LoaispTableMap::COL_DANHMUC_MADM] = true;
        }

        if ($this->aDanhmuc !== null && $this->aDanhmuc->getMadm() !== $v) {
            $this->aDanhmuc = null;
        }

        return $this;
    } // setDanhmucMadm()

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
        // otherwise, everything was equal, so return TRUE
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LoaispTableMap::translateFieldName('Maloaisp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maloaisp = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LoaispTableMap::translateFieldName('Tenloaisp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tenloaisp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LoaispTableMap::translateFieldName('DanhmucMadm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->danhmuc_madm = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = LoaispTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Loaisp'), 0, $e);
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
        if ($this->aDanhmuc !== null && $this->danhmuc_madm !== $this->aDanhmuc->getMadm()) {
            $this->aDanhmuc = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoaispTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLoaispQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDanhmuc = null;
            $this->collSanphams = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Loaisp::setDeleted()
     * @see Loaisp::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoaispTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLoaispQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoaispTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                LoaispTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aDanhmuc !== null) {
                if ($this->aDanhmuc->isModified() || $this->aDanhmuc->isNew()) {
                    $affectedRows += $this->aDanhmuc->save($con);
                }
                $this->setDanhmuc($this->aDanhmuc);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->sanphamsScheduledForDeletion !== null) {
                if (!$this->sanphamsScheduledForDeletion->isEmpty()) {
                    \Model\SanphamQuery::create()
                        ->filterByPrimaryKeys($this->sanphamsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sanphamsScheduledForDeletion = null;
                }
            }

            if ($this->collSanphams !== null) {
                foreach ($this->collSanphams as $referrerFK) {
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
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[LoaispTableMap::COL_MALOAISP] = true;
        if (null !== $this->maloaisp) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LoaispTableMap::COL_MALOAISP . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LoaispTableMap::COL_MALOAISP)) {
            $modifiedColumns[':p' . $index++]  = 'MaLoaiSP';
        }
        if ($this->isColumnModified(LoaispTableMap::COL_TENLOAISP)) {
            $modifiedColumns[':p' . $index++]  = 'TenLoaiSP';
        }
        if ($this->isColumnModified(LoaispTableMap::COL_DANHMUC_MADM)) {
            $modifiedColumns[':p' . $index++]  = 'DanhMuc_MaDM';
        }

        $sql = sprintf(
            'INSERT INTO LoaiSP (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'MaLoaiSP':
                        $stmt->bindValue($identifier, $this->maloaisp, PDO::PARAM_INT);
                        break;
                    case 'TenLoaiSP':
                        $stmt->bindValue($identifier, $this->tenloaisp, PDO::PARAM_STR);
                        break;
                    case 'DanhMuc_MaDM':
                        $stmt->bindValue($identifier, $this->danhmuc_madm, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setMaloaisp($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LoaispTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getMaloaisp();
                break;
            case 1:
                return $this->getTenloaisp();
                break;
            case 2:
                return $this->getDanhmucMadm();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Loaisp'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Loaisp'][$this->hashCode()] = true;
        $keys = LoaispTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getMaloaisp(),
            $keys[1] => $this->getTenloaisp(),
            $keys[2] => $this->getDanhmucMadm(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDanhmuc) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'danhmuc';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'DanhMuc';
                        break;
                    default:
                        $key = 'Danhmuc';
                }

                $result[$key] = $this->aDanhmuc->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSanphams) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sanphams';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Sanphams';
                        break;
                    default:
                        $key = 'Sanphams';
                }

                $result[$key] = $this->collSanphams->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Model\Loaisp
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LoaispTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Loaisp
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setMaloaisp($value);
                break;
            case 1:
                $this->setTenloaisp($value);
                break;
            case 2:
                $this->setDanhmucMadm($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = LoaispTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMaloaisp($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTenloaisp($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDanhmucMadm($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Model\Loaisp The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LoaispTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LoaispTableMap::COL_MALOAISP)) {
            $criteria->add(LoaispTableMap::COL_MALOAISP, $this->maloaisp);
        }
        if ($this->isColumnModified(LoaispTableMap::COL_TENLOAISP)) {
            $criteria->add(LoaispTableMap::COL_TENLOAISP, $this->tenloaisp);
        }
        if ($this->isColumnModified(LoaispTableMap::COL_DANHMUC_MADM)) {
            $criteria->add(LoaispTableMap::COL_DANHMUC_MADM, $this->danhmuc_madm);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildLoaispQuery::create();
        $criteria->add(LoaispTableMap::COL_MALOAISP, $this->maloaisp);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getMaloaisp();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getMaloaisp();
    }

    /**
     * Generic method to set the primary key (maloaisp column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setMaloaisp($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getMaloaisp();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\Loaisp (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTenloaisp($this->getTenloaisp());
        $copyObj->setDanhmucMadm($this->getDanhmucMadm());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSanphams() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSanpham($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMaloaisp(NULL); // this is a auto-increment column, so set to default value
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
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Model\Loaisp Clone of current object.
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
     * Declares an association between this object and a ChildDanhmuc object.
     *
     * @param  ChildDanhmuc $v
     * @return $this|\Model\Loaisp The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDanhmuc(ChildDanhmuc $v = null)
    {
        if ($v === null) {
            $this->setDanhmucMadm(NULL);
        } else {
            $this->setDanhmucMadm($v->getMadm());
        }

        $this->aDanhmuc = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDanhmuc object, it will not be re-added.
        if ($v !== null) {
            $v->addLoaisp($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDanhmuc object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDanhmuc The associated ChildDanhmuc object.
     * @throws PropelException
     */
    public function getDanhmuc(ConnectionInterface $con = null)
    {
        if ($this->aDanhmuc === null && ($this->danhmuc_madm !== null)) {
            $this->aDanhmuc = ChildDanhmucQuery::create()->findPk($this->danhmuc_madm, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDanhmuc->addLoaisps($this);
             */
        }

        return $this->aDanhmuc;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Sanpham' == $relationName) {
            return $this->initSanphams();
        }
    }

    /**
     * Clears out the collSanphams collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSanphams()
     */
    public function clearSanphams()
    {
        $this->collSanphams = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSanphams collection loaded partially.
     */
    public function resetPartialSanphams($v = true)
    {
        $this->collSanphamsPartial = $v;
    }

    /**
     * Initializes the collSanphams collection.
     *
     * By default this just sets the collSanphams collection to an empty array (like clearcollSanphams());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSanphams($overrideExisting = true)
    {
        if (null !== $this->collSanphams && !$overrideExisting) {
            return;
        }

        $collectionClassName = SanphamTableMap::getTableMap()->getCollectionClassName();

        $this->collSanphams = new $collectionClassName;
        $this->collSanphams->setModel('\Model\Sanpham');
    }

    /**
     * Gets an array of ChildSanpham objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLoaisp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSanpham[] List of ChildSanpham objects
     * @throws PropelException
     */
    public function getSanphams(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSanphamsPartial && !$this->isNew();
        if (null === $this->collSanphams || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSanphams) {
                // return empty collection
                $this->initSanphams();
            } else {
                $collSanphams = ChildSanphamQuery::create(null, $criteria)
                    ->filterByLoaisp($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSanphamsPartial && count($collSanphams)) {
                        $this->initSanphams(false);

                        foreach ($collSanphams as $obj) {
                            if (false == $this->collSanphams->contains($obj)) {
                                $this->collSanphams->append($obj);
                            }
                        }

                        $this->collSanphamsPartial = true;
                    }

                    return $collSanphams;
                }

                if ($partial && $this->collSanphams) {
                    foreach ($this->collSanphams as $obj) {
                        if ($obj->isNew()) {
                            $collSanphams[] = $obj;
                        }
                    }
                }

                $this->collSanphams = $collSanphams;
                $this->collSanphamsPartial = false;
            }
        }

        return $this->collSanphams;
    }

    /**
     * Sets a collection of ChildSanpham objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $sanphams A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLoaisp The current object (for fluent API support)
     */
    public function setSanphams(Collection $sanphams, ConnectionInterface $con = null)
    {
        /** @var ChildSanpham[] $sanphamsToDelete */
        $sanphamsToDelete = $this->getSanphams(new Criteria(), $con)->diff($sanphams);


        $this->sanphamsScheduledForDeletion = $sanphamsToDelete;

        foreach ($sanphamsToDelete as $sanphamRemoved) {
            $sanphamRemoved->setLoaisp(null);
        }

        $this->collSanphams = null;
        foreach ($sanphams as $sanpham) {
            $this->addSanpham($sanpham);
        }

        $this->collSanphams = $sanphams;
        $this->collSanphamsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Sanpham objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Sanpham objects.
     * @throws PropelException
     */
    public function countSanphams(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSanphamsPartial && !$this->isNew();
        if (null === $this->collSanphams || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSanphams) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSanphams());
            }

            $query = ChildSanphamQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLoaisp($this)
                ->count($con);
        }

        return count($this->collSanphams);
    }

    /**
     * Method called to associate a ChildSanpham object to this object
     * through the ChildSanpham foreign key attribute.
     *
     * @param  ChildSanpham $l ChildSanpham
     * @return $this|\Model\Loaisp The current object (for fluent API support)
     */
    public function addSanpham(ChildSanpham $l)
    {
        if ($this->collSanphams === null) {
            $this->initSanphams();
            $this->collSanphamsPartial = true;
        }

        if (!$this->collSanphams->contains($l)) {
            $this->doAddSanpham($l);

            if ($this->sanphamsScheduledForDeletion and $this->sanphamsScheduledForDeletion->contains($l)) {
                $this->sanphamsScheduledForDeletion->remove($this->sanphamsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSanpham $sanpham The ChildSanpham object to add.
     */
    protected function doAddSanpham(ChildSanpham $sanpham)
    {
        $this->collSanphams[]= $sanpham;
        $sanpham->setLoaisp($this);
    }

    /**
     * @param  ChildSanpham $sanpham The ChildSanpham object to remove.
     * @return $this|ChildLoaisp The current object (for fluent API support)
     */
    public function removeSanpham(ChildSanpham $sanpham)
    {
        if ($this->getSanphams()->contains($sanpham)) {
            $pos = $this->collSanphams->search($sanpham);
            $this->collSanphams->remove($pos);
            if (null === $this->sanphamsScheduledForDeletion) {
                $this->sanphamsScheduledForDeletion = clone $this->collSanphams;
                $this->sanphamsScheduledForDeletion->clear();
            }
            $this->sanphamsScheduledForDeletion[]= clone $sanpham;
            $sanpham->setLoaisp(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDanhmuc) {
            $this->aDanhmuc->removeLoaisp($this);
        }
        $this->maloaisp = null;
        $this->tenloaisp = null;
        $this->danhmuc_madm = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collSanphams) {
                foreach ($this->collSanphams as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSanphams = null;
        $this->aDanhmuc = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LoaispTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
