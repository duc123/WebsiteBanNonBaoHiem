<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Ctpdh as ChildCtpdh;
use Model\CtpdhQuery as ChildCtpdhQuery;
use Model\Loaisp as ChildLoaisp;
use Model\LoaispQuery as ChildLoaispQuery;
use Model\Sanpham as ChildSanpham;
use Model\SanphamQuery as ChildSanphamQuery;
use Model\Map\CtpdhTableMap;
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
 * Base class that represents a row from the 'Sanpham' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Sanpham implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\SanphamTableMap';


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
     * The value for the masanpham field.
     *
     * @var        int
     */
    protected $masanpham;

    /**
     * The value for the tensanpham field.
     *
     * @var        string
     */
    protected $tensanpham;

    /**
     * The value for the hinhanh field.
     *
     * @var        string
     */
    protected $hinhanh;

    /**
     * The value for the giasp field.
     *
     * @var        string
     */
    protected $giasp;

    /**
     * The value for the donvitinh field.
     *
     * @var        string
     */
    protected $donvitinh;

    /**
     * The value for the thongtin field.
     *
     * @var        string
     */
    protected $thongtin;

    /**
     * The value for the loaisp_maloaisp field.
     *
     * @var        int
     */
    protected $loaisp_maloaisp;

    /**
     * The value for the gianhap field.
     *
     * @var        string
     */
    protected $gianhap;

    /**
     * The value for the luotxem field.
     *
     * @var        int
     */
    protected $luotxem;

    /**
     * @var        ChildLoaisp
     */
    protected $aLoaisp;

    /**
     * @var        ObjectCollection|ChildCtpdh[] Collection to store aggregation of ChildCtpdh objects.
     */
    protected $collCtpdhs;
    protected $collCtpdhsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCtpdh[]
     */
    protected $ctpdhsScheduledForDeletion = null;

    /**
     * Initializes internal state of Model\Base\Sanpham object.
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
     * Compares this with another <code>Sanpham</code> instance.  If
     * <code>obj</code> is an instance of <code>Sanpham</code>, delegates to
     * <code>equals(Sanpham)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Sanpham The current object, for fluid interface
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
     * Get the [masanpham] column value.
     *
     * @return int
     */
    public function getMasanpham()
    {
        return $this->masanpham;
    }

    /**
     * Get the [tensanpham] column value.
     *
     * @return string
     */
    public function getTensanpham()
    {
        return $this->tensanpham;
    }

    /**
     * Get the [hinhanh] column value.
     *
     * @return string
     */
    public function getHinhanh()
    {
        return $this->hinhanh;
    }

    /**
     * Get the [giasp] column value.
     *
     * @return string
     */
    public function getGiasp()
    {
        return $this->giasp;
    }

    /**
     * Get the [donvitinh] column value.
     *
     * @return string
     */
    public function getDonvitinh()
    {
        return $this->donvitinh;
    }

    /**
     * Get the [thongtin] column value.
     *
     * @return string
     */
    public function getThongtin()
    {
        return $this->thongtin;
    }

    /**
     * Get the [loaisp_maloaisp] column value.
     *
     * @return int
     */
    public function getLoaispMaloaisp()
    {
        return $this->loaisp_maloaisp;
    }

    /**
     * Get the [gianhap] column value.
     *
     * @return string
     */
    public function getGianhap()
    {
        return $this->gianhap;
    }

    /**
     * Get the [luotxem] column value.
     *
     * @return int
     */
    public function getLuotxem()
    {
        return $this->luotxem;
    }

    /**
     * Set the value of [masanpham] column.
     *
     * @param int $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setMasanpham($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->masanpham !== $v) {
            $this->masanpham = $v;
            $this->modifiedColumns[SanphamTableMap::COL_MASANPHAM] = true;
        }

        return $this;
    } // setMasanpham()

    /**
     * Set the value of [tensanpham] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setTensanpham($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tensanpham !== $v) {
            $this->tensanpham = $v;
            $this->modifiedColumns[SanphamTableMap::COL_TENSANPHAM] = true;
        }

        return $this;
    } // setTensanpham()

    /**
     * Set the value of [hinhanh] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setHinhanh($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hinhanh !== $v) {
            $this->hinhanh = $v;
            $this->modifiedColumns[SanphamTableMap::COL_HINHANH] = true;
        }

        return $this;
    } // setHinhanh()

    /**
     * Set the value of [giasp] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setGiasp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->giasp !== $v) {
            $this->giasp = $v;
            $this->modifiedColumns[SanphamTableMap::COL_GIASP] = true;
        }

        return $this;
    } // setGiasp()

    /**
     * Set the value of [donvitinh] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setDonvitinh($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->donvitinh !== $v) {
            $this->donvitinh = $v;
            $this->modifiedColumns[SanphamTableMap::COL_DONVITINH] = true;
        }

        return $this;
    } // setDonvitinh()

    /**
     * Set the value of [thongtin] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setThongtin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thongtin !== $v) {
            $this->thongtin = $v;
            $this->modifiedColumns[SanphamTableMap::COL_THONGTIN] = true;
        }

        return $this;
    } // setThongtin()

    /**
     * Set the value of [loaisp_maloaisp] column.
     *
     * @param int $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setLoaispMaloaisp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->loaisp_maloaisp !== $v) {
            $this->loaisp_maloaisp = $v;
            $this->modifiedColumns[SanphamTableMap::COL_LOAISP_MALOAISP] = true;
        }

        if ($this->aLoaisp !== null && $this->aLoaisp->getMaloaisp() !== $v) {
            $this->aLoaisp = null;
        }

        return $this;
    } // setLoaispMaloaisp()

    /**
     * Set the value of [gianhap] column.
     *
     * @param string $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setGianhap($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gianhap !== $v) {
            $this->gianhap = $v;
            $this->modifiedColumns[SanphamTableMap::COL_GIANHAP] = true;
        }

        return $this;
    } // setGianhap()

    /**
     * Set the value of [luotxem] column.
     *
     * @param int $v new value
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function setLuotxem($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->luotxem !== $v) {
            $this->luotxem = $v;
            $this->modifiedColumns[SanphamTableMap::COL_LUOTXEM] = true;
        }

        return $this;
    } // setLuotxem()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SanphamTableMap::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)];
            $this->masanpham = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SanphamTableMap::translateFieldName('Tensanpham', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tensanpham = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SanphamTableMap::translateFieldName('Hinhanh', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hinhanh = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SanphamTableMap::translateFieldName('Giasp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->giasp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SanphamTableMap::translateFieldName('Donvitinh', TableMap::TYPE_PHPNAME, $indexType)];
            $this->donvitinh = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SanphamTableMap::translateFieldName('Thongtin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thongtin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SanphamTableMap::translateFieldName('LoaispMaloaisp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->loaisp_maloaisp = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SanphamTableMap::translateFieldName('Gianhap', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gianhap = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SanphamTableMap::translateFieldName('Luotxem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->luotxem = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = SanphamTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Sanpham'), 0, $e);
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
        if ($this->aLoaisp !== null && $this->loaisp_maloaisp !== $this->aLoaisp->getMaloaisp()) {
            $this->aLoaisp = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SanphamTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSanphamQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLoaisp = null;
            $this->collCtpdhs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Sanpham::setDeleted()
     * @see Sanpham::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSanphamQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
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
                SanphamTableMap::addInstanceToPool($this);
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

            if ($this->aLoaisp !== null) {
                if ($this->aLoaisp->isModified() || $this->aLoaisp->isNew()) {
                    $affectedRows += $this->aLoaisp->save($con);
                }
                $this->setLoaisp($this->aLoaisp);
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

            if ($this->ctpdhsScheduledForDeletion !== null) {
                if (!$this->ctpdhsScheduledForDeletion->isEmpty()) {
                    \Model\CtpdhQuery::create()
                        ->filterByPrimaryKeys($this->ctpdhsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ctpdhsScheduledForDeletion = null;
                }
            }

            if ($this->collCtpdhs !== null) {
                foreach ($this->collCtpdhs as $referrerFK) {
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

        $this->modifiedColumns[SanphamTableMap::COL_MASANPHAM] = true;
        if (null !== $this->masanpham) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SanphamTableMap::COL_MASANPHAM . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SanphamTableMap::COL_MASANPHAM)) {
            $modifiedColumns[':p' . $index++]  = 'MaSanpham';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_TENSANPHAM)) {
            $modifiedColumns[':p' . $index++]  = 'TenSanpham';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_HINHANH)) {
            $modifiedColumns[':p' . $index++]  = 'HInhAnh';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_GIASP)) {
            $modifiedColumns[':p' . $index++]  = 'GiaSP';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_DONVITINH)) {
            $modifiedColumns[':p' . $index++]  = 'DonViTinh';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_THONGTIN)) {
            $modifiedColumns[':p' . $index++]  = 'ThongTin';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_LOAISP_MALOAISP)) {
            $modifiedColumns[':p' . $index++]  = 'LoaiSP_MaLoaiSP';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_GIANHAP)) {
            $modifiedColumns[':p' . $index++]  = 'GiaNhap';
        }
        if ($this->isColumnModified(SanphamTableMap::COL_LUOTXEM)) {
            $modifiedColumns[':p' . $index++]  = 'LuotXem';
        }

        $sql = sprintf(
            'INSERT INTO Sanpham (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'MaSanpham':
                        $stmt->bindValue($identifier, $this->masanpham, PDO::PARAM_INT);
                        break;
                    case 'TenSanpham':
                        $stmt->bindValue($identifier, $this->tensanpham, PDO::PARAM_STR);
                        break;
                    case 'HInhAnh':
                        $stmt->bindValue($identifier, $this->hinhanh, PDO::PARAM_STR);
                        break;
                    case 'GiaSP':
                        $stmt->bindValue($identifier, $this->giasp, PDO::PARAM_STR);
                        break;
                    case 'DonViTinh':
                        $stmt->bindValue($identifier, $this->donvitinh, PDO::PARAM_STR);
                        break;
                    case 'ThongTin':
                        $stmt->bindValue($identifier, $this->thongtin, PDO::PARAM_STR);
                        break;
                    case 'LoaiSP_MaLoaiSP':
                        $stmt->bindValue($identifier, $this->loaisp_maloaisp, PDO::PARAM_INT);
                        break;
                    case 'GiaNhap':
                        $stmt->bindValue($identifier, $this->gianhap, PDO::PARAM_STR);
                        break;
                    case 'LuotXem':
                        $stmt->bindValue($identifier, $this->luotxem, PDO::PARAM_INT);
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
        $this->setMasanpham($pk);

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
        $pos = SanphamTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMasanpham();
                break;
            case 1:
                return $this->getTensanpham();
                break;
            case 2:
                return $this->getHinhanh();
                break;
            case 3:
                return $this->getGiasp();
                break;
            case 4:
                return $this->getDonvitinh();
                break;
            case 5:
                return $this->getThongtin();
                break;
            case 6:
                return $this->getLoaispMaloaisp();
                break;
            case 7:
                return $this->getGianhap();
                break;
            case 8:
                return $this->getLuotxem();
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

        if (isset($alreadyDumpedObjects['Sanpham'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Sanpham'][$this->hashCode()] = true;
        $keys = SanphamTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getMasanpham(),
            $keys[1] => $this->getTensanpham(),
            $keys[2] => $this->getHinhanh(),
            $keys[3] => $this->getGiasp(),
            $keys[4] => $this->getDonvitinh(),
            $keys[5] => $this->getThongtin(),
            $keys[6] => $this->getLoaispMaloaisp(),
            $keys[7] => $this->getGianhap(),
            $keys[8] => $this->getLuotxem(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLoaisp) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'loaisp';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'LoaiSP';
                        break;
                    default:
                        $key = 'Loaisp';
                }

                $result[$key] = $this->aLoaisp->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCtpdhs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ctpdhs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'CTPDHs';
                        break;
                    default:
                        $key = 'Ctpdhs';
                }

                $result[$key] = $this->collCtpdhs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Model\Sanpham
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SanphamTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Sanpham
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setMasanpham($value);
                break;
            case 1:
                $this->setTensanpham($value);
                break;
            case 2:
                $this->setHinhanh($value);
                break;
            case 3:
                $this->setGiasp($value);
                break;
            case 4:
                $this->setDonvitinh($value);
                break;
            case 5:
                $this->setThongtin($value);
                break;
            case 6:
                $this->setLoaispMaloaisp($value);
                break;
            case 7:
                $this->setGianhap($value);
                break;
            case 8:
                $this->setLuotxem($value);
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
        $keys = SanphamTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMasanpham($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTensanpham($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setHinhanh($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setGiasp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDonvitinh($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setThongtin($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLoaispMaloaisp($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGianhap($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setLuotxem($arr[$keys[8]]);
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
     * @return $this|\Model\Sanpham The current object, for fluid interface
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
        $criteria = new Criteria(SanphamTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SanphamTableMap::COL_MASANPHAM)) {
            $criteria->add(SanphamTableMap::COL_MASANPHAM, $this->masanpham);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_TENSANPHAM)) {
            $criteria->add(SanphamTableMap::COL_TENSANPHAM, $this->tensanpham);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_HINHANH)) {
            $criteria->add(SanphamTableMap::COL_HINHANH, $this->hinhanh);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_GIASP)) {
            $criteria->add(SanphamTableMap::COL_GIASP, $this->giasp);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_DONVITINH)) {
            $criteria->add(SanphamTableMap::COL_DONVITINH, $this->donvitinh);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_THONGTIN)) {
            $criteria->add(SanphamTableMap::COL_THONGTIN, $this->thongtin);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_LOAISP_MALOAISP)) {
            $criteria->add(SanphamTableMap::COL_LOAISP_MALOAISP, $this->loaisp_maloaisp);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_GIANHAP)) {
            $criteria->add(SanphamTableMap::COL_GIANHAP, $this->gianhap);
        }
        if ($this->isColumnModified(SanphamTableMap::COL_LUOTXEM)) {
            $criteria->add(SanphamTableMap::COL_LUOTXEM, $this->luotxem);
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
        $criteria = ChildSanphamQuery::create();
        $criteria->add(SanphamTableMap::COL_MASANPHAM, $this->masanpham);

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
        $validPk = null !== $this->getMasanpham();

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
        return $this->getMasanpham();
    }

    /**
     * Generic method to set the primary key (masanpham column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setMasanpham($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getMasanpham();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\Sanpham (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTensanpham($this->getTensanpham());
        $copyObj->setHinhanh($this->getHinhanh());
        $copyObj->setGiasp($this->getGiasp());
        $copyObj->setDonvitinh($this->getDonvitinh());
        $copyObj->setThongtin($this->getThongtin());
        $copyObj->setLoaispMaloaisp($this->getLoaispMaloaisp());
        $copyObj->setGianhap($this->getGianhap());
        $copyObj->setLuotxem($this->getLuotxem());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCtpdhs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCtpdh($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMasanpham(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Model\Sanpham Clone of current object.
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
     * Declares an association between this object and a ChildLoaisp object.
     *
     * @param  ChildLoaisp $v
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLoaisp(ChildLoaisp $v = null)
    {
        if ($v === null) {
            $this->setLoaispMaloaisp(NULL);
        } else {
            $this->setLoaispMaloaisp($v->getMaloaisp());
        }

        $this->aLoaisp = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLoaisp object, it will not be re-added.
        if ($v !== null) {
            $v->addSanpham($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLoaisp object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLoaisp The associated ChildLoaisp object.
     * @throws PropelException
     */
    public function getLoaisp(ConnectionInterface $con = null)
    {
        if ($this->aLoaisp === null && ($this->loaisp_maloaisp !== null)) {
            $this->aLoaisp = ChildLoaispQuery::create()->findPk($this->loaisp_maloaisp, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLoaisp->addSanphams($this);
             */
        }

        return $this->aLoaisp;
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
        if ('Ctpdh' == $relationName) {
            return $this->initCtpdhs();
        }
    }

    /**
     * Clears out the collCtpdhs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCtpdhs()
     */
    public function clearCtpdhs()
    {
        $this->collCtpdhs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCtpdhs collection loaded partially.
     */
    public function resetPartialCtpdhs($v = true)
    {
        $this->collCtpdhsPartial = $v;
    }

    /**
     * Initializes the collCtpdhs collection.
     *
     * By default this just sets the collCtpdhs collection to an empty array (like clearcollCtpdhs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCtpdhs($overrideExisting = true)
    {
        if (null !== $this->collCtpdhs && !$overrideExisting) {
            return;
        }

        $collectionClassName = CtpdhTableMap::getTableMap()->getCollectionClassName();

        $this->collCtpdhs = new $collectionClassName;
        $this->collCtpdhs->setModel('\Model\Ctpdh');
    }

    /**
     * Gets an array of ChildCtpdh objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSanpham is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCtpdh[] List of ChildCtpdh objects
     * @throws PropelException
     */
    public function getCtpdhs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCtpdhsPartial && !$this->isNew();
        if (null === $this->collCtpdhs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCtpdhs) {
                // return empty collection
                $this->initCtpdhs();
            } else {
                $collCtpdhs = ChildCtpdhQuery::create(null, $criteria)
                    ->filterBySanpham($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCtpdhsPartial && count($collCtpdhs)) {
                        $this->initCtpdhs(false);

                        foreach ($collCtpdhs as $obj) {
                            if (false == $this->collCtpdhs->contains($obj)) {
                                $this->collCtpdhs->append($obj);
                            }
                        }

                        $this->collCtpdhsPartial = true;
                    }

                    return $collCtpdhs;
                }

                if ($partial && $this->collCtpdhs) {
                    foreach ($this->collCtpdhs as $obj) {
                        if ($obj->isNew()) {
                            $collCtpdhs[] = $obj;
                        }
                    }
                }

                $this->collCtpdhs = $collCtpdhs;
                $this->collCtpdhsPartial = false;
            }
        }

        return $this->collCtpdhs;
    }

    /**
     * Sets a collection of ChildCtpdh objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ctpdhs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSanpham The current object (for fluent API support)
     */
    public function setCtpdhs(Collection $ctpdhs, ConnectionInterface $con = null)
    {
        /** @var ChildCtpdh[] $ctpdhsToDelete */
        $ctpdhsToDelete = $this->getCtpdhs(new Criteria(), $con)->diff($ctpdhs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ctpdhsScheduledForDeletion = clone $ctpdhsToDelete;

        foreach ($ctpdhsToDelete as $ctpdhRemoved) {
            $ctpdhRemoved->setSanpham(null);
        }

        $this->collCtpdhs = null;
        foreach ($ctpdhs as $ctpdh) {
            $this->addCtpdh($ctpdh);
        }

        $this->collCtpdhs = $ctpdhs;
        $this->collCtpdhsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ctpdh objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Ctpdh objects.
     * @throws PropelException
     */
    public function countCtpdhs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCtpdhsPartial && !$this->isNew();
        if (null === $this->collCtpdhs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCtpdhs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCtpdhs());
            }

            $query = ChildCtpdhQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySanpham($this)
                ->count($con);
        }

        return count($this->collCtpdhs);
    }

    /**
     * Method called to associate a ChildCtpdh object to this object
     * through the ChildCtpdh foreign key attribute.
     *
     * @param  ChildCtpdh $l ChildCtpdh
     * @return $this|\Model\Sanpham The current object (for fluent API support)
     */
    public function addCtpdh(ChildCtpdh $l)
    {
        if ($this->collCtpdhs === null) {
            $this->initCtpdhs();
            $this->collCtpdhsPartial = true;
        }

        if (!$this->collCtpdhs->contains($l)) {
            $this->doAddCtpdh($l);

            if ($this->ctpdhsScheduledForDeletion and $this->ctpdhsScheduledForDeletion->contains($l)) {
                $this->ctpdhsScheduledForDeletion->remove($this->ctpdhsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCtpdh $ctpdh The ChildCtpdh object to add.
     */
    protected function doAddCtpdh(ChildCtpdh $ctpdh)
    {
        $this->collCtpdhs[]= $ctpdh;
        $ctpdh->setSanpham($this);
    }

    /**
     * @param  ChildCtpdh $ctpdh The ChildCtpdh object to remove.
     * @return $this|ChildSanpham The current object (for fluent API support)
     */
    public function removeCtpdh(ChildCtpdh $ctpdh)
    {
        if ($this->getCtpdhs()->contains($ctpdh)) {
            $pos = $this->collCtpdhs->search($ctpdh);
            $this->collCtpdhs->remove($pos);
            if (null === $this->ctpdhsScheduledForDeletion) {
                $this->ctpdhsScheduledForDeletion = clone $this->collCtpdhs;
                $this->ctpdhsScheduledForDeletion->clear();
            }
            $this->ctpdhsScheduledForDeletion[]= clone $ctpdh;
            $ctpdh->setSanpham(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sanpham is new, it will return
     * an empty collection; or if this Sanpham has previously
     * been saved, it will retrieve related Ctpdhs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sanpham.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCtpdh[] List of ChildCtpdh objects
     */
    public function getCtpdhsJoinPhieudathang(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCtpdhQuery::create(null, $criteria);
        $query->joinWith('Phieudathang', $joinBehavior);

        return $this->getCtpdhs($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLoaisp) {
            $this->aLoaisp->removeSanpham($this);
        }
        $this->masanpham = null;
        $this->tensanpham = null;
        $this->hinhanh = null;
        $this->giasp = null;
        $this->donvitinh = null;
        $this->thongtin = null;
        $this->loaisp_maloaisp = null;
        $this->gianhap = null;
        $this->luotxem = null;
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
            if ($this->collCtpdhs) {
                foreach ($this->collCtpdhs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCtpdhs = null;
        $this->aLoaisp = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SanphamTableMap::DEFAULT_STRING_FORMAT);
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
