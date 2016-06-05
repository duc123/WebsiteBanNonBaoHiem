<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Khachhang as ChildKhachhang;
use Model\KhachhangQuery as ChildKhachhangQuery;
use Model\Phieudathang as ChildPhieudathang;
use Model\PhieudathangQuery as ChildPhieudathangQuery;
use Model\Map\KhachhangTableMap;
use Model\Map\PhieudathangTableMap;
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
 * Base class that represents a row from the 'KhachHang' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Khachhang implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\KhachhangTableMap';


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
     * The value for the makh field.
     *
     * @var        int
     */
    protected $makh;

    /**
     * The value for the tenkh field.
     *
     * @var        string
     */
    protected $tenkh;

    /**
     * The value for the dt field.
     *
     * @var        string
     */
    protected $dt;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the diachi field.
     *
     * @var        string
     */
    protected $diachi;

    /**
     * The value for the thanhpho field.
     *
     * @var        string
     */
    protected $thanhpho;

    /**
     * The value for the quan_huyen field.
     *
     * @var        string
     */
    protected $quan_huyen;

    /**
     * The value for the phuong_xa field.
     *
     * @var        string
     */
    protected $phuong_xa;

    /**
     * @var        ObjectCollection|ChildPhieudathang[] Collection to store aggregation of ChildPhieudathang objects.
     */
    protected $collPhieudathangs;
    protected $collPhieudathangsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPhieudathang[]
     */
    protected $phieudathangsScheduledForDeletion = null;

    /**
     * Initializes internal state of Model\Base\Khachhang object.
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
     * Compares this with another <code>Khachhang</code> instance.  If
     * <code>obj</code> is an instance of <code>Khachhang</code>, delegates to
     * <code>equals(Khachhang)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Khachhang The current object, for fluid interface
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
     * Get the [makh] column value.
     *
     * @return int
     */
    public function getMakh()
    {
        return $this->makh;
    }

    /**
     * Get the [tenkh] column value.
     *
     * @return string
     */
    public function getTenkh()
    {
        return $this->tenkh;
    }

    /**
     * Get the [dt] column value.
     *
     * @return string
     */
    public function getDt()
    {
        return $this->dt;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [diachi] column value.
     *
     * @return string
     */
    public function getDiachi()
    {
        return $this->diachi;
    }

    /**
     * Get the [thanhpho] column value.
     *
     * @return string
     */
    public function getThanhpho()
    {
        return $this->thanhpho;
    }

    /**
     * Get the [quan_huyen] column value.
     *
     * @return string
     */
    public function getQuanHuyen()
    {
        return $this->quan_huyen;
    }

    /**
     * Get the [phuong_xa] column value.
     *
     * @return string
     */
    public function getPhuongXa()
    {
        return $this->phuong_xa;
    }

    /**
     * Set the value of [makh] column.
     *
     * @param int $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setMakh($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->makh !== $v) {
            $this->makh = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_MAKH] = true;
        }

        return $this;
    } // setMakh()

    /**
     * Set the value of [tenkh] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setTenkh($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tenkh !== $v) {
            $this->tenkh = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_TENKH] = true;
        }

        return $this;
    } // setTenkh()

    /**
     * Set the value of [dt] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setDt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dt !== $v) {
            $this->dt = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_DT] = true;
        }

        return $this;
    } // setDt()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [diachi] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setDiachi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->diachi !== $v) {
            $this->diachi = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_DIACHI] = true;
        }

        return $this;
    } // setDiachi()

    /**
     * Set the value of [thanhpho] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setThanhpho($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thanhpho !== $v) {
            $this->thanhpho = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_THANHPHO] = true;
        }

        return $this;
    } // setThanhpho()

    /**
     * Set the value of [quan_huyen] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setQuanHuyen($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quan_huyen !== $v) {
            $this->quan_huyen = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_QUAN_HUYEN] = true;
        }

        return $this;
    } // setQuanHuyen()

    /**
     * Set the value of [phuong_xa] column.
     *
     * @param string $v new value
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function setPhuongXa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phuong_xa !== $v) {
            $this->phuong_xa = $v;
            $this->modifiedColumns[KhachhangTableMap::COL_PHUONG_XA] = true;
        }

        return $this;
    } // setPhuongXa()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : KhachhangTableMap::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)];
            $this->makh = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : KhachhangTableMap::translateFieldName('Tenkh', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tenkh = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : KhachhangTableMap::translateFieldName('Dt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : KhachhangTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : KhachhangTableMap::translateFieldName('Diachi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->diachi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : KhachhangTableMap::translateFieldName('Thanhpho', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thanhpho = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : KhachhangTableMap::translateFieldName('QuanHuyen', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quan_huyen = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : KhachhangTableMap::translateFieldName('PhuongXa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phuong_xa = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = KhachhangTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Khachhang'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(KhachhangTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildKhachhangQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPhieudathangs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Khachhang::setDeleted()
     * @see Khachhang::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildKhachhangQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
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
                KhachhangTableMap::addInstanceToPool($this);
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

            if ($this->phieudathangsScheduledForDeletion !== null) {
                if (!$this->phieudathangsScheduledForDeletion->isEmpty()) {
                    \Model\PhieudathangQuery::create()
                        ->filterByPrimaryKeys($this->phieudathangsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->phieudathangsScheduledForDeletion = null;
                }
            }

            if ($this->collPhieudathangs !== null) {
                foreach ($this->collPhieudathangs as $referrerFK) {
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

        $this->modifiedColumns[KhachhangTableMap::COL_MAKH] = true;
        if (null !== $this->makh) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . KhachhangTableMap::COL_MAKH . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(KhachhangTableMap::COL_MAKH)) {
            $modifiedColumns[':p' . $index++]  = 'MaKH';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_TENKH)) {
            $modifiedColumns[':p' . $index++]  = 'TenKH';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_DT)) {
            $modifiedColumns[':p' . $index++]  = 'DT';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'Email';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_DIACHI)) {
            $modifiedColumns[':p' . $index++]  = 'DiaChi';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_THANHPHO)) {
            $modifiedColumns[':p' . $index++]  = 'ThanhPho';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_QUAN_HUYEN)) {
            $modifiedColumns[':p' . $index++]  = 'Quan_Huyen';
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_PHUONG_XA)) {
            $modifiedColumns[':p' . $index++]  = 'Phuong_Xa';
        }

        $sql = sprintf(
            'INSERT INTO KhachHang (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'MaKH':
                        $stmt->bindValue($identifier, $this->makh, PDO::PARAM_INT);
                        break;
                    case 'TenKH':
                        $stmt->bindValue($identifier, $this->tenkh, PDO::PARAM_STR);
                        break;
                    case 'DT':
                        $stmt->bindValue($identifier, $this->dt, PDO::PARAM_STR);
                        break;
                    case 'Email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'DiaChi':
                        $stmt->bindValue($identifier, $this->diachi, PDO::PARAM_STR);
                        break;
                    case 'ThanhPho':
                        $stmt->bindValue($identifier, $this->thanhpho, PDO::PARAM_STR);
                        break;
                    case 'Quan_Huyen':
                        $stmt->bindValue($identifier, $this->quan_huyen, PDO::PARAM_STR);
                        break;
                    case 'Phuong_Xa':
                        $stmt->bindValue($identifier, $this->phuong_xa, PDO::PARAM_STR);
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
        $this->setMakh($pk);

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
        $pos = KhachhangTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMakh();
                break;
            case 1:
                return $this->getTenkh();
                break;
            case 2:
                return $this->getDt();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getDiachi();
                break;
            case 5:
                return $this->getThanhpho();
                break;
            case 6:
                return $this->getQuanHuyen();
                break;
            case 7:
                return $this->getPhuongXa();
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

        if (isset($alreadyDumpedObjects['Khachhang'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Khachhang'][$this->hashCode()] = true;
        $keys = KhachhangTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getMakh(),
            $keys[1] => $this->getTenkh(),
            $keys[2] => $this->getDt(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getDiachi(),
            $keys[5] => $this->getThanhpho(),
            $keys[6] => $this->getQuanHuyen(),
            $keys[7] => $this->getPhuongXa(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPhieudathangs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'phieudathangs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'PhieuDatHangs';
                        break;
                    default:
                        $key = 'Phieudathangs';
                }

                $result[$key] = $this->collPhieudathangs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Model\Khachhang
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = KhachhangTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Khachhang
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setMakh($value);
                break;
            case 1:
                $this->setTenkh($value);
                break;
            case 2:
                $this->setDt($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setDiachi($value);
                break;
            case 5:
                $this->setThanhpho($value);
                break;
            case 6:
                $this->setQuanHuyen($value);
                break;
            case 7:
                $this->setPhuongXa($value);
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
        $keys = KhachhangTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMakh($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTenkh($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDiachi($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setThanhpho($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQuanHuyen($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPhuongXa($arr[$keys[7]]);
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
     * @return $this|\Model\Khachhang The current object, for fluid interface
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
        $criteria = new Criteria(KhachhangTableMap::DATABASE_NAME);

        if ($this->isColumnModified(KhachhangTableMap::COL_MAKH)) {
            $criteria->add(KhachhangTableMap::COL_MAKH, $this->makh);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_TENKH)) {
            $criteria->add(KhachhangTableMap::COL_TENKH, $this->tenkh);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_DT)) {
            $criteria->add(KhachhangTableMap::COL_DT, $this->dt);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_EMAIL)) {
            $criteria->add(KhachhangTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_DIACHI)) {
            $criteria->add(KhachhangTableMap::COL_DIACHI, $this->diachi);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_THANHPHO)) {
            $criteria->add(KhachhangTableMap::COL_THANHPHO, $this->thanhpho);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_QUAN_HUYEN)) {
            $criteria->add(KhachhangTableMap::COL_QUAN_HUYEN, $this->quan_huyen);
        }
        if ($this->isColumnModified(KhachhangTableMap::COL_PHUONG_XA)) {
            $criteria->add(KhachhangTableMap::COL_PHUONG_XA, $this->phuong_xa);
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
        $criteria = ChildKhachhangQuery::create();
        $criteria->add(KhachhangTableMap::COL_MAKH, $this->makh);

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
        $validPk = null !== $this->getMakh();

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
        return $this->getMakh();
    }

    /**
     * Generic method to set the primary key (makh column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setMakh($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getMakh();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\Khachhang (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTenkh($this->getTenkh());
        $copyObj->setDt($this->getDt());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setDiachi($this->getDiachi());
        $copyObj->setThanhpho($this->getThanhpho());
        $copyObj->setQuanHuyen($this->getQuanHuyen());
        $copyObj->setPhuongXa($this->getPhuongXa());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPhieudathangs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPhieudathang($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMakh(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Model\Khachhang Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Phieudathang' == $relationName) {
            return $this->initPhieudathangs();
        }
    }

    /**
     * Clears out the collPhieudathangs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPhieudathangs()
     */
    public function clearPhieudathangs()
    {
        $this->collPhieudathangs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPhieudathangs collection loaded partially.
     */
    public function resetPartialPhieudathangs($v = true)
    {
        $this->collPhieudathangsPartial = $v;
    }

    /**
     * Initializes the collPhieudathangs collection.
     *
     * By default this just sets the collPhieudathangs collection to an empty array (like clearcollPhieudathangs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPhieudathangs($overrideExisting = true)
    {
        if (null !== $this->collPhieudathangs && !$overrideExisting) {
            return;
        }

        $collectionClassName = PhieudathangTableMap::getTableMap()->getCollectionClassName();

        $this->collPhieudathangs = new $collectionClassName;
        $this->collPhieudathangs->setModel('\Model\Phieudathang');
    }

    /**
     * Gets an array of ChildPhieudathang objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildKhachhang is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPhieudathang[] List of ChildPhieudathang objects
     * @throws PropelException
     */
    public function getPhieudathangs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPhieudathangsPartial && !$this->isNew();
        if (null === $this->collPhieudathangs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPhieudathangs) {
                // return empty collection
                $this->initPhieudathangs();
            } else {
                $collPhieudathangs = ChildPhieudathangQuery::create(null, $criteria)
                    ->filterByKhachhang($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPhieudathangsPartial && count($collPhieudathangs)) {
                        $this->initPhieudathangs(false);

                        foreach ($collPhieudathangs as $obj) {
                            if (false == $this->collPhieudathangs->contains($obj)) {
                                $this->collPhieudathangs->append($obj);
                            }
                        }

                        $this->collPhieudathangsPartial = true;
                    }

                    return $collPhieudathangs;
                }

                if ($partial && $this->collPhieudathangs) {
                    foreach ($this->collPhieudathangs as $obj) {
                        if ($obj->isNew()) {
                            $collPhieudathangs[] = $obj;
                        }
                    }
                }

                $this->collPhieudathangs = $collPhieudathangs;
                $this->collPhieudathangsPartial = false;
            }
        }

        return $this->collPhieudathangs;
    }

    /**
     * Sets a collection of ChildPhieudathang objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $phieudathangs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildKhachhang The current object (for fluent API support)
     */
    public function setPhieudathangs(Collection $phieudathangs, ConnectionInterface $con = null)
    {
        /** @var ChildPhieudathang[] $phieudathangsToDelete */
        $phieudathangsToDelete = $this->getPhieudathangs(new Criteria(), $con)->diff($phieudathangs);


        $this->phieudathangsScheduledForDeletion = $phieudathangsToDelete;

        foreach ($phieudathangsToDelete as $phieudathangRemoved) {
            $phieudathangRemoved->setKhachhang(null);
        }

        $this->collPhieudathangs = null;
        foreach ($phieudathangs as $phieudathang) {
            $this->addPhieudathang($phieudathang);
        }

        $this->collPhieudathangs = $phieudathangs;
        $this->collPhieudathangsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Phieudathang objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Phieudathang objects.
     * @throws PropelException
     */
    public function countPhieudathangs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPhieudathangsPartial && !$this->isNew();
        if (null === $this->collPhieudathangs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPhieudathangs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPhieudathangs());
            }

            $query = ChildPhieudathangQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByKhachhang($this)
                ->count($con);
        }

        return count($this->collPhieudathangs);
    }

    /**
     * Method called to associate a ChildPhieudathang object to this object
     * through the ChildPhieudathang foreign key attribute.
     *
     * @param  ChildPhieudathang $l ChildPhieudathang
     * @return $this|\Model\Khachhang The current object (for fluent API support)
     */
    public function addPhieudathang(ChildPhieudathang $l)
    {
        if ($this->collPhieudathangs === null) {
            $this->initPhieudathangs();
            $this->collPhieudathangsPartial = true;
        }

        if (!$this->collPhieudathangs->contains($l)) {
            $this->doAddPhieudathang($l);

            if ($this->phieudathangsScheduledForDeletion and $this->phieudathangsScheduledForDeletion->contains($l)) {
                $this->phieudathangsScheduledForDeletion->remove($this->phieudathangsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPhieudathang $phieudathang The ChildPhieudathang object to add.
     */
    protected function doAddPhieudathang(ChildPhieudathang $phieudathang)
    {
        $this->collPhieudathangs[]= $phieudathang;
        $phieudathang->setKhachhang($this);
    }

    /**
     * @param  ChildPhieudathang $phieudathang The ChildPhieudathang object to remove.
     * @return $this|ChildKhachhang The current object (for fluent API support)
     */
    public function removePhieudathang(ChildPhieudathang $phieudathang)
    {
        if ($this->getPhieudathangs()->contains($phieudathang)) {
            $pos = $this->collPhieudathangs->search($phieudathang);
            $this->collPhieudathangs->remove($pos);
            if (null === $this->phieudathangsScheduledForDeletion) {
                $this->phieudathangsScheduledForDeletion = clone $this->collPhieudathangs;
                $this->phieudathangsScheduledForDeletion->clear();
            }
            $this->phieudathangsScheduledForDeletion[]= clone $phieudathang;
            $phieudathang->setKhachhang(null);
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
        $this->makh = null;
        $this->tenkh = null;
        $this->dt = null;
        $this->email = null;
        $this->diachi = null;
        $this->thanhpho = null;
        $this->quan_huyen = null;
        $this->phuong_xa = null;
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
            if ($this->collPhieudathangs) {
                foreach ($this->collPhieudathangs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPhieudathangs = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(KhachhangTableMap::DEFAULT_STRING_FORMAT);
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
