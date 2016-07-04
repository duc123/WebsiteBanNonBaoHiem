<?php

namespace Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Model\Ctpdh as ChildCtpdh;
use Model\CtpdhQuery as ChildCtpdhQuery;
use Model\Khachhang as ChildKhachhang;
use Model\KhachhangQuery as ChildKhachhangQuery;
use Model\Phieudathang as ChildPhieudathang;
use Model\PhieudathangQuery as ChildPhieudathangQuery;
use Model\Map\CtpdhTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'PhieuDatHang' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Phieudathang implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\PhieudathangTableMap';


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
     * The value for the sophieu field.
     *
     * @var        int
     */
    protected $sophieu;

    /**
     * The value for the ngaylap field.
     *
     * @var        DateTime
     */
    protected $ngaylap;

    /**
     * The value for the tennguoinhan field.
     *
     * @var        string
     */
    protected $tennguoinhan;

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
     * The value for the chiphi field.
     *
     * @var        string
     */
    protected $chiphi;

    /**
     * The value for the khachhang_makh field.
     *
     * @var        int
     */
    protected $khachhang_makh;

    /**
     * The value for the tongtien field.
     *
     * @var        string
     */
    protected $tongtien;

    /**
     * The value for the ngaygiao field.
     *
     * @var        DateTime
     */
    protected $ngaygiao;

    /**
     * The value for the tinhtrang field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $tinhtrang;

    /**
     * The value for the sodienthoai field.
     *
     * @var        string
     */
    protected $sodienthoai;

    /**
     * @var        ChildKhachhang
     */
    protected $aKhachhang;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->tinhtrang = false;
    }

    /**
     * Initializes internal state of Model\Base\Phieudathang object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Phieudathang</code> instance.  If
     * <code>obj</code> is an instance of <code>Phieudathang</code>, delegates to
     * <code>equals(Phieudathang)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Phieudathang The current object, for fluid interface
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
     * Get the [sophieu] column value.
     *
     * @return int
     */
    public function getSophieu()
    {
        return $this->sophieu;
    }

    /**
     * Get the [optionally formatted] temporal [ngaylap] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNgaylap($format = NULL)
    {
        if ($format === null) {
            return $this->ngaylap;
        } else {
            return $this->ngaylap instanceof \DateTimeInterface ? $this->ngaylap->format($format) : null;
        }
    }

    /**
     * Get the [tennguoinhan] column value.
     *
     * @return string
     */
    public function getTennguoinhan()
    {
        return $this->tennguoinhan;
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
     * Get the [chiphi] column value.
     *
     * @return string
     */
    public function getChiphi()
    {
        return $this->chiphi;
    }

    /**
     * Get the [khachhang_makh] column value.
     *
     * @return int
     */
    public function getKhachhangMakh()
    {
        return $this->khachhang_makh;
    }

    /**
     * Get the [tongtien] column value.
     *
     * @return string
     */
    public function getTongtien()
    {
        return $this->tongtien;
    }

    /**
     * Get the [optionally formatted] temporal [ngaygiao] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNgaygiao($format = NULL)
    {
        if ($format === null) {
            return $this->ngaygiao;
        } else {
            return $this->ngaygiao instanceof \DateTimeInterface ? $this->ngaygiao->format($format) : null;
        }
    }

    /**
     * Get the [tinhtrang] column value.
     *
     * @return boolean
     */
    public function getTinhtrang()
    {
        return $this->tinhtrang;
    }

    /**
     * Get the [tinhtrang] column value.
     *
     * @return boolean
     */
    public function isTinhtrang()
    {
        return $this->getTinhtrang();
    }

    /**
     * Get the [sodienthoai] column value.
     *
     * @return string
     */
    public function getSodienthoai()
    {
        return $this->sodienthoai;
    }

    /**
     * Set the value of [sophieu] column.
     *
     * @param int $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setSophieu($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sophieu !== $v) {
            $this->sophieu = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_SOPHIEU] = true;
        }

        return $this;
    } // setSophieu()

    /**
     * Sets the value of [ngaylap] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setNgaylap($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->ngaylap !== null || $dt !== null) {
            if ($this->ngaylap === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->ngaylap->format("Y-m-d H:i:s.u")) {
                $this->ngaylap = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PhieudathangTableMap::COL_NGAYLAP] = true;
            }
        } // if either are not null

        return $this;
    } // setNgaylap()

    /**
     * Set the value of [tennguoinhan] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setTennguoinhan($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tennguoinhan !== $v) {
            $this->tennguoinhan = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_TENNGUOINHAN] = true;
        }

        return $this;
    } // setTennguoinhan()

    /**
     * Set the value of [diachi] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setDiachi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->diachi !== $v) {
            $this->diachi = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_DIACHI] = true;
        }

        return $this;
    } // setDiachi()

    /**
     * Set the value of [thanhpho] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setThanhpho($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thanhpho !== $v) {
            $this->thanhpho = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_THANHPHO] = true;
        }

        return $this;
    } // setThanhpho()

    /**
     * Set the value of [quan_huyen] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setQuanHuyen($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quan_huyen !== $v) {
            $this->quan_huyen = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_QUAN_HUYEN] = true;
        }

        return $this;
    } // setQuanHuyen()

    /**
     * Set the value of [phuong_xa] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setPhuongXa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phuong_xa !== $v) {
            $this->phuong_xa = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_PHUONG_XA] = true;
        }

        return $this;
    } // setPhuongXa()

    /**
     * Set the value of [chiphi] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setChiphi($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->chiphi !== $v) {
            $this->chiphi = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_CHIPHI] = true;
        }

        return $this;
    } // setChiphi()

    /**
     * Set the value of [khachhang_makh] column.
     *
     * @param int $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setKhachhangMakh($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->khachhang_makh !== $v) {
            $this->khachhang_makh = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_KHACHHANG_MAKH] = true;
        }

        if ($this->aKhachhang !== null && $this->aKhachhang->getMakh() !== $v) {
            $this->aKhachhang = null;
        }

        return $this;
    } // setKhachhangMakh()

    /**
     * Set the value of [tongtien] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setTongtien($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tongtien !== $v) {
            $this->tongtien = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_TONGTIEN] = true;
        }

        return $this;
    } // setTongtien()

    /**
     * Sets the value of [ngaygiao] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setNgaygiao($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->ngaygiao !== null || $dt !== null) {
            if ($this->ngaygiao === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->ngaygiao->format("Y-m-d H:i:s.u")) {
                $this->ngaygiao = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PhieudathangTableMap::COL_NGAYGIAO] = true;
            }
        } // if either are not null

        return $this;
    } // setNgaygiao()

    /**
     * Sets the value of the [tinhtrang] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setTinhtrang($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->tinhtrang !== $v) {
            $this->tinhtrang = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_TINHTRANG] = true;
        }

        return $this;
    } // setTinhtrang()

    /**
     * Set the value of [sodienthoai] column.
     *
     * @param string $v new value
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     */
    public function setSodienthoai($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sodienthoai !== $v) {
            $this->sodienthoai = $v;
            $this->modifiedColumns[PhieudathangTableMap::COL_SODIENTHOAI] = true;
        }

        return $this;
    } // setSodienthoai()

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
            if ($this->tinhtrang !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PhieudathangTableMap::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sophieu = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PhieudathangTableMap::translateFieldName('Ngaylap', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->ngaylap = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PhieudathangTableMap::translateFieldName('Tennguoinhan', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tennguoinhan = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PhieudathangTableMap::translateFieldName('Diachi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->diachi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PhieudathangTableMap::translateFieldName('Thanhpho', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thanhpho = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PhieudathangTableMap::translateFieldName('QuanHuyen', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quan_huyen = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PhieudathangTableMap::translateFieldName('PhuongXa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phuong_xa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PhieudathangTableMap::translateFieldName('Chiphi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->chiphi = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PhieudathangTableMap::translateFieldName('KhachhangMakh', TableMap::TYPE_PHPNAME, $indexType)];
            $this->khachhang_makh = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PhieudathangTableMap::translateFieldName('Tongtien', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tongtien = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PhieudathangTableMap::translateFieldName('Ngaygiao', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->ngaygiao = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PhieudathangTableMap::translateFieldName('Tinhtrang', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tinhtrang = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PhieudathangTableMap::translateFieldName('Sodienthoai', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sodienthoai = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = PhieudathangTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Phieudathang'), 0, $e);
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
        if ($this->aKhachhang !== null && $this->khachhang_makh !== $this->aKhachhang->getMakh()) {
            $this->aKhachhang = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPhieudathangQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aKhachhang = null;
            $this->collCtpdhs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Phieudathang::setDeleted()
     * @see Phieudathang::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPhieudathangQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
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
                PhieudathangTableMap::addInstanceToPool($this);
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

            if ($this->aKhachhang !== null) {
                if ($this->aKhachhang->isModified() || $this->aKhachhang->isNew()) {
                    $affectedRows += $this->aKhachhang->save($con);
                }
                $this->setKhachhang($this->aKhachhang);
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

        $this->modifiedColumns[PhieudathangTableMap::COL_SOPHIEU] = true;
        if (null !== $this->sophieu) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PhieudathangTableMap::COL_SOPHIEU . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PhieudathangTableMap::COL_SOPHIEU)) {
            $modifiedColumns[':p' . $index++]  = 'SoPhieu';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_NGAYLAP)) {
            $modifiedColumns[':p' . $index++]  = 'NgayLap';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TENNGUOINHAN)) {
            $modifiedColumns[':p' . $index++]  = 'TenNguoiNhan';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_DIACHI)) {
            $modifiedColumns[':p' . $index++]  = 'DiaChi';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_THANHPHO)) {
            $modifiedColumns[':p' . $index++]  = 'ThanhPho';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_QUAN_HUYEN)) {
            $modifiedColumns[':p' . $index++]  = 'Quan_Huyen';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_PHUONG_XA)) {
            $modifiedColumns[':p' . $index++]  = 'Phuong_Xa';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_CHIPHI)) {
            $modifiedColumns[':p' . $index++]  = 'ChiPhi';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_KHACHHANG_MAKH)) {
            $modifiedColumns[':p' . $index++]  = 'KhachHang_MaKH';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TONGTIEN)) {
            $modifiedColumns[':p' . $index++]  = 'TongTien';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_NGAYGIAO)) {
            $modifiedColumns[':p' . $index++]  = 'NgayGiao';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TINHTRANG)) {
            $modifiedColumns[':p' . $index++]  = 'TinhTrang';
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_SODIENTHOAI)) {
            $modifiedColumns[':p' . $index++]  = 'SoDienThoai';
        }

        $sql = sprintf(
            'INSERT INTO PhieuDatHang (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'SoPhieu':
                        $stmt->bindValue($identifier, $this->sophieu, PDO::PARAM_INT);
                        break;
                    case 'NgayLap':
                        $stmt->bindValue($identifier, $this->ngaylap ? $this->ngaylap->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'TenNguoiNhan':
                        $stmt->bindValue($identifier, $this->tennguoinhan, PDO::PARAM_STR);
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
                    case 'ChiPhi':
                        $stmt->bindValue($identifier, $this->chiphi, PDO::PARAM_STR);
                        break;
                    case 'KhachHang_MaKH':
                        $stmt->bindValue($identifier, $this->khachhang_makh, PDO::PARAM_INT);
                        break;
                    case 'TongTien':
                        $stmt->bindValue($identifier, $this->tongtien, PDO::PARAM_STR);
                        break;
                    case 'NgayGiao':
                        $stmt->bindValue($identifier, $this->ngaygiao ? $this->ngaygiao->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'TinhTrang':
                        $stmt->bindValue($identifier, (int) $this->tinhtrang, PDO::PARAM_INT);
                        break;
                    case 'SoDienThoai':
                        $stmt->bindValue($identifier, $this->sodienthoai, PDO::PARAM_STR);
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
        $this->setSophieu($pk);

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
        $pos = PhieudathangTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSophieu();
                break;
            case 1:
                return $this->getNgaylap();
                break;
            case 2:
                return $this->getTennguoinhan();
                break;
            case 3:
                return $this->getDiachi();
                break;
            case 4:
                return $this->getThanhpho();
                break;
            case 5:
                return $this->getQuanHuyen();
                break;
            case 6:
                return $this->getPhuongXa();
                break;
            case 7:
                return $this->getChiphi();
                break;
            case 8:
                return $this->getKhachhangMakh();
                break;
            case 9:
                return $this->getTongtien();
                break;
            case 10:
                return $this->getNgaygiao();
                break;
            case 11:
                return $this->getTinhtrang();
                break;
            case 12:
                return $this->getSodienthoai();
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

        if (isset($alreadyDumpedObjects['Phieudathang'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Phieudathang'][$this->hashCode()] = true;
        $keys = PhieudathangTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getSophieu(),
            $keys[1] => $this->getNgaylap(),
            $keys[2] => $this->getTennguoinhan(),
            $keys[3] => $this->getDiachi(),
            $keys[4] => $this->getThanhpho(),
            $keys[5] => $this->getQuanHuyen(),
            $keys[6] => $this->getPhuongXa(),
            $keys[7] => $this->getChiphi(),
            $keys[8] => $this->getKhachhangMakh(),
            $keys[9] => $this->getTongtien(),
            $keys[10] => $this->getNgaygiao(),
            $keys[11] => $this->getTinhtrang(),
            $keys[12] => $this->getSodienthoai(),
        );
        if ($result[$keys[1]] instanceof \DateTime) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTime) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aKhachhang) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'khachhang';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'KhachHang';
                        break;
                    default:
                        $key = 'Khachhang';
                }

                $result[$key] = $this->aKhachhang->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Model\Phieudathang
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PhieudathangTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Phieudathang
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setSophieu($value);
                break;
            case 1:
                $this->setNgaylap($value);
                break;
            case 2:
                $this->setTennguoinhan($value);
                break;
            case 3:
                $this->setDiachi($value);
                break;
            case 4:
                $this->setThanhpho($value);
                break;
            case 5:
                $this->setQuanHuyen($value);
                break;
            case 6:
                $this->setPhuongXa($value);
                break;
            case 7:
                $this->setChiphi($value);
                break;
            case 8:
                $this->setKhachhangMakh($value);
                break;
            case 9:
                $this->setTongtien($value);
                break;
            case 10:
                $this->setNgaygiao($value);
                break;
            case 11:
                $this->setTinhtrang($value);
                break;
            case 12:
                $this->setSodienthoai($value);
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
        $keys = PhieudathangTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSophieu($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNgaylap($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTennguoinhan($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDiachi($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setThanhpho($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQuanHuyen($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPhuongXa($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setChiphi($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setKhachhangMakh($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTongtien($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setNgaygiao($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTinhtrang($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setSodienthoai($arr[$keys[12]]);
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
     * @return $this|\Model\Phieudathang The current object, for fluid interface
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
        $criteria = new Criteria(PhieudathangTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PhieudathangTableMap::COL_SOPHIEU)) {
            $criteria->add(PhieudathangTableMap::COL_SOPHIEU, $this->sophieu);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_NGAYLAP)) {
            $criteria->add(PhieudathangTableMap::COL_NGAYLAP, $this->ngaylap);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TENNGUOINHAN)) {
            $criteria->add(PhieudathangTableMap::COL_TENNGUOINHAN, $this->tennguoinhan);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_DIACHI)) {
            $criteria->add(PhieudathangTableMap::COL_DIACHI, $this->diachi);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_THANHPHO)) {
            $criteria->add(PhieudathangTableMap::COL_THANHPHO, $this->thanhpho);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_QUAN_HUYEN)) {
            $criteria->add(PhieudathangTableMap::COL_QUAN_HUYEN, $this->quan_huyen);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_PHUONG_XA)) {
            $criteria->add(PhieudathangTableMap::COL_PHUONG_XA, $this->phuong_xa);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_CHIPHI)) {
            $criteria->add(PhieudathangTableMap::COL_CHIPHI, $this->chiphi);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_KHACHHANG_MAKH)) {
            $criteria->add(PhieudathangTableMap::COL_KHACHHANG_MAKH, $this->khachhang_makh);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TONGTIEN)) {
            $criteria->add(PhieudathangTableMap::COL_TONGTIEN, $this->tongtien);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_NGAYGIAO)) {
            $criteria->add(PhieudathangTableMap::COL_NGAYGIAO, $this->ngaygiao);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_TINHTRANG)) {
            $criteria->add(PhieudathangTableMap::COL_TINHTRANG, $this->tinhtrang);
        }
        if ($this->isColumnModified(PhieudathangTableMap::COL_SODIENTHOAI)) {
            $criteria->add(PhieudathangTableMap::COL_SODIENTHOAI, $this->sodienthoai);
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
        $criteria = ChildPhieudathangQuery::create();
        $criteria->add(PhieudathangTableMap::COL_SOPHIEU, $this->sophieu);

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
        $validPk = null !== $this->getSophieu();

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
        return $this->getSophieu();
    }

    /**
     * Generic method to set the primary key (sophieu column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setSophieu($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getSophieu();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\Phieudathang (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNgaylap($this->getNgaylap());
        $copyObj->setTennguoinhan($this->getTennguoinhan());
        $copyObj->setDiachi($this->getDiachi());
        $copyObj->setThanhpho($this->getThanhpho());
        $copyObj->setQuanHuyen($this->getQuanHuyen());
        $copyObj->setPhuongXa($this->getPhuongXa());
        $copyObj->setChiphi($this->getChiphi());
        $copyObj->setKhachhangMakh($this->getKhachhangMakh());
        $copyObj->setTongtien($this->getTongtien());
        $copyObj->setNgaygiao($this->getNgaygiao());
        $copyObj->setTinhtrang($this->getTinhtrang());
        $copyObj->setSodienthoai($this->getSodienthoai());

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
            $copyObj->setSophieu(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Model\Phieudathang Clone of current object.
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
     * Declares an association between this object and a ChildKhachhang object.
     *
     * @param  ChildKhachhang $v
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
     * @throws PropelException
     */
    public function setKhachhang(ChildKhachhang $v = null)
    {
        if ($v === null) {
            $this->setKhachhangMakh(NULL);
        } else {
            $this->setKhachhangMakh($v->getMakh());
        }

        $this->aKhachhang = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildKhachhang object, it will not be re-added.
        if ($v !== null) {
            $v->addPhieudathang($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildKhachhang object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildKhachhang The associated ChildKhachhang object.
     * @throws PropelException
     */
    public function getKhachhang(ConnectionInterface $con = null)
    {
        if ($this->aKhachhang === null && ($this->khachhang_makh !== null)) {
            $this->aKhachhang = ChildKhachhangQuery::create()->findPk($this->khachhang_makh, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aKhachhang->addPhieudathangs($this);
             */
        }

        return $this->aKhachhang;
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
     * If this ChildPhieudathang is new, it will return
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
                    ->filterByPhieudathang($this)
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
     * @return $this|ChildPhieudathang The current object (for fluent API support)
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
            $ctpdhRemoved->setPhieudathang(null);
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
                ->filterByPhieudathang($this)
                ->count($con);
        }

        return count($this->collCtpdhs);
    }

    /**
     * Method called to associate a ChildCtpdh object to this object
     * through the ChildCtpdh foreign key attribute.
     *
     * @param  ChildCtpdh $l ChildCtpdh
     * @return $this|\Model\Phieudathang The current object (for fluent API support)
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
        $ctpdh->setPhieudathang($this);
    }

    /**
     * @param  ChildCtpdh $ctpdh The ChildCtpdh object to remove.
     * @return $this|ChildPhieudathang The current object (for fluent API support)
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
            $ctpdh->setPhieudathang(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Phieudathang is new, it will return
     * an empty collection; or if this Phieudathang has previously
     * been saved, it will retrieve related Ctpdhs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Phieudathang.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCtpdh[] List of ChildCtpdh objects
     */
    public function getCtpdhsJoinSanpham(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCtpdhQuery::create(null, $criteria);
        $query->joinWith('Sanpham', $joinBehavior);

        return $this->getCtpdhs($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aKhachhang) {
            $this->aKhachhang->removePhieudathang($this);
        }
        $this->sophieu = null;
        $this->ngaylap = null;
        $this->tennguoinhan = null;
        $this->diachi = null;
        $this->thanhpho = null;
        $this->quan_huyen = null;
        $this->phuong_xa = null;
        $this->chiphi = null;
        $this->khachhang_makh = null;
        $this->tongtien = null;
        $this->ngaygiao = null;
        $this->tinhtrang = null;
        $this->sodienthoai = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
        $this->aKhachhang = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PhieudathangTableMap::DEFAULT_STRING_FORMAT);
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
