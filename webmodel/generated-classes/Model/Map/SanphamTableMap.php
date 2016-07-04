<?php

namespace Model\Map;

use Model\Sanpham;
use Model\SanphamQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'Sanpham' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SanphamTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.SanphamTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quanlybanhang';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Sanpham';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Sanpham';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Sanpham';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the MaSanpham field
     */
    const COL_MASANPHAM = 'Sanpham.MaSanpham';

    /**
     * the column name for the TenSanpham field
     */
    const COL_TENSANPHAM = 'Sanpham.TenSanpham';

    /**
     * the column name for the HInhAnh field
     */
    const COL_HINHANH = 'Sanpham.HInhAnh';

    /**
     * the column name for the GiaSP field
     */
    const COL_GIASP = 'Sanpham.GiaSP';

    /**
     * the column name for the DonViTinh field
     */
    const COL_DONVITINH = 'Sanpham.DonViTinh';

    /**
     * the column name for the ThongTin field
     */
    const COL_THONGTIN = 'Sanpham.ThongTin';

    /**
     * the column name for the LoaiSP_MaLoaiSP field
     */
    const COL_LOAISP_MALOAISP = 'Sanpham.LoaiSP_MaLoaiSP';

    /**
     * the column name for the GiaNhap field
     */
    const COL_GIANHAP = 'Sanpham.GiaNhap';

    /**
     * the column name for the LuotXem field
     */
    const COL_LUOTXEM = 'Sanpham.LuotXem';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Masanpham', 'Tensanpham', 'Hinhanh', 'Giasp', 'Donvitinh', 'Thongtin', 'LoaispMaloaisp', 'Gianhap', 'Luotxem', ),
        self::TYPE_CAMELNAME     => array('masanpham', 'tensanpham', 'hinhanh', 'giasp', 'donvitinh', 'thongtin', 'loaispMaloaisp', 'gianhap', 'luotxem', ),
        self::TYPE_COLNAME       => array(SanphamTableMap::COL_MASANPHAM, SanphamTableMap::COL_TENSANPHAM, SanphamTableMap::COL_HINHANH, SanphamTableMap::COL_GIASP, SanphamTableMap::COL_DONVITINH, SanphamTableMap::COL_THONGTIN, SanphamTableMap::COL_LOAISP_MALOAISP, SanphamTableMap::COL_GIANHAP, SanphamTableMap::COL_LUOTXEM, ),
        self::TYPE_FIELDNAME     => array('MaSanpham', 'TenSanpham', 'HInhAnh', 'GiaSP', 'DonViTinh', 'ThongTin', 'LoaiSP_MaLoaiSP', 'GiaNhap', 'LuotXem', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Masanpham' => 0, 'Tensanpham' => 1, 'Hinhanh' => 2, 'Giasp' => 3, 'Donvitinh' => 4, 'Thongtin' => 5, 'LoaispMaloaisp' => 6, 'Gianhap' => 7, 'Luotxem' => 8, ),
        self::TYPE_CAMELNAME     => array('masanpham' => 0, 'tensanpham' => 1, 'hinhanh' => 2, 'giasp' => 3, 'donvitinh' => 4, 'thongtin' => 5, 'loaispMaloaisp' => 6, 'gianhap' => 7, 'luotxem' => 8, ),
        self::TYPE_COLNAME       => array(SanphamTableMap::COL_MASANPHAM => 0, SanphamTableMap::COL_TENSANPHAM => 1, SanphamTableMap::COL_HINHANH => 2, SanphamTableMap::COL_GIASP => 3, SanphamTableMap::COL_DONVITINH => 4, SanphamTableMap::COL_THONGTIN => 5, SanphamTableMap::COL_LOAISP_MALOAISP => 6, SanphamTableMap::COL_GIANHAP => 7, SanphamTableMap::COL_LUOTXEM => 8, ),
        self::TYPE_FIELDNAME     => array('MaSanpham' => 0, 'TenSanpham' => 1, 'HInhAnh' => 2, 'GiaSP' => 3, 'DonViTinh' => 4, 'ThongTin' => 5, 'LoaiSP_MaLoaiSP' => 6, 'GiaNhap' => 7, 'LuotXem' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Sanpham');
        $this->setPhpName('Sanpham');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Sanpham');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MaSanpham', 'Masanpham', 'INTEGER', true, null, null);
        $this->addColumn('TenSanpham', 'Tensanpham', 'VARCHAR', true, 20, null);
        $this->addColumn('HInhAnh', 'Hinhanh', 'VARCHAR', false, 50, null);
        $this->addColumn('GiaSP', 'Giasp', 'DECIMAL', true, 15, null);
        $this->addColumn('DonViTinh', 'Donvitinh', 'CHAR', true, 5, null);
        $this->addColumn('ThongTin', 'Thongtin', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('LoaiSP_MaLoaiSP', 'LoaispMaloaisp', 'INTEGER', 'LoaiSP', 'MaLoaiSP', true, null, null);
        $this->addColumn('GiaNhap', 'Gianhap', 'DECIMAL', false, 15, null);
        $this->addColumn('LuotXem', 'Luotxem', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Loaisp', '\\Model\\Loaisp', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':LoaiSP_MaLoaiSP',
    1 => ':MaLoaiSP',
  ),
), null, null, null, false);
        $this->addRelation('Ctpdh', '\\Model\\Ctpdh', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':Sanpham_MaSanpham',
    1 => ':MaSanpham',
  ),
), null, null, 'Ctpdhs', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Masanpham', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SanphamTableMap::CLASS_DEFAULT : SanphamTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Sanpham object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SanphamTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SanphamTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SanphamTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SanphamTableMap::OM_CLASS;
            /** @var Sanpham $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SanphamTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SanphamTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SanphamTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Sanpham $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SanphamTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SanphamTableMap::COL_MASANPHAM);
            $criteria->addSelectColumn(SanphamTableMap::COL_TENSANPHAM);
            $criteria->addSelectColumn(SanphamTableMap::COL_HINHANH);
            $criteria->addSelectColumn(SanphamTableMap::COL_GIASP);
            $criteria->addSelectColumn(SanphamTableMap::COL_DONVITINH);
            $criteria->addSelectColumn(SanphamTableMap::COL_THONGTIN);
            $criteria->addSelectColumn(SanphamTableMap::COL_LOAISP_MALOAISP);
            $criteria->addSelectColumn(SanphamTableMap::COL_GIANHAP);
            $criteria->addSelectColumn(SanphamTableMap::COL_LUOTXEM);
        } else {
            $criteria->addSelectColumn($alias . '.MaSanpham');
            $criteria->addSelectColumn($alias . '.TenSanpham');
            $criteria->addSelectColumn($alias . '.HInhAnh');
            $criteria->addSelectColumn($alias . '.GiaSP');
            $criteria->addSelectColumn($alias . '.DonViTinh');
            $criteria->addSelectColumn($alias . '.ThongTin');
            $criteria->addSelectColumn($alias . '.LoaiSP_MaLoaiSP');
            $criteria->addSelectColumn($alias . '.GiaNhap');
            $criteria->addSelectColumn($alias . '.LuotXem');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SanphamTableMap::DATABASE_NAME)->getTable(SanphamTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SanphamTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SanphamTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SanphamTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Sanpham or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Sanpham object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Sanpham) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SanphamTableMap::DATABASE_NAME);
            $criteria->add(SanphamTableMap::COL_MASANPHAM, (array) $values, Criteria::IN);
        }

        $query = SanphamQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SanphamTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SanphamTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Sanpham table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SanphamQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Sanpham or Criteria object.
     *
     * @param mixed               $criteria Criteria or Sanpham object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Sanpham object
        }

        if ($criteria->containsKey(SanphamTableMap::COL_MASANPHAM) && $criteria->keyContainsValue(SanphamTableMap::COL_MASANPHAM) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SanphamTableMap::COL_MASANPHAM.')');
        }


        // Set the correct dbName
        $query = SanphamQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SanphamTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SanphamTableMap::buildTableMap();
