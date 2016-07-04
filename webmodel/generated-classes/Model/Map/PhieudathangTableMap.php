<?php

namespace Model\Map;

use Model\Phieudathang;
use Model\PhieudathangQuery;
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
 * This class defines the structure of the 'PhieuDatHang' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PhieudathangTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.PhieudathangTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quanlybanhang';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'PhieuDatHang';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Phieudathang';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Phieudathang';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the SoPhieu field
     */
    const COL_SOPHIEU = 'PhieuDatHang.SoPhieu';

    /**
     * the column name for the NgayLap field
     */
    const COL_NGAYLAP = 'PhieuDatHang.NgayLap';

    /**
     * the column name for the TenNguoiNhan field
     */
    const COL_TENNGUOINHAN = 'PhieuDatHang.TenNguoiNhan';

    /**
     * the column name for the DiaChi field
     */
    const COL_DIACHI = 'PhieuDatHang.DiaChi';

    /**
     * the column name for the ThanhPho field
     */
    const COL_THANHPHO = 'PhieuDatHang.ThanhPho';

    /**
     * the column name for the Quan_Huyen field
     */
    const COL_QUAN_HUYEN = 'PhieuDatHang.Quan_Huyen';

    /**
     * the column name for the Phuong_Xa field
     */
    const COL_PHUONG_XA = 'PhieuDatHang.Phuong_Xa';

    /**
     * the column name for the ChiPhi field
     */
    const COL_CHIPHI = 'PhieuDatHang.ChiPhi';

    /**
     * the column name for the KhachHang_MaKH field
     */
    const COL_KHACHHANG_MAKH = 'PhieuDatHang.KhachHang_MaKH';

    /**
     * the column name for the TongTien field
     */
    const COL_TONGTIEN = 'PhieuDatHang.TongTien';

    /**
     * the column name for the NgayGiao field
     */
    const COL_NGAYGIAO = 'PhieuDatHang.NgayGiao';

    /**
     * the column name for the TinhTrang field
     */
    const COL_TINHTRANG = 'PhieuDatHang.TinhTrang';

    /**
     * the column name for the SoDienThoai field
     */
    const COL_SODIENTHOAI = 'PhieuDatHang.SoDienThoai';

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
        self::TYPE_PHPNAME       => array('Sophieu', 'Ngaylap', 'Tennguoinhan', 'Diachi', 'Thanhpho', 'QuanHuyen', 'PhuongXa', 'Chiphi', 'KhachhangMakh', 'Tongtien', 'Ngaygiao', 'Tinhtrang', 'Sodienthoai', ),
        self::TYPE_CAMELNAME     => array('sophieu', 'ngaylap', 'tennguoinhan', 'diachi', 'thanhpho', 'quanHuyen', 'phuongXa', 'chiphi', 'khachhangMakh', 'tongtien', 'ngaygiao', 'tinhtrang', 'sodienthoai', ),
        self::TYPE_COLNAME       => array(PhieudathangTableMap::COL_SOPHIEU, PhieudathangTableMap::COL_NGAYLAP, PhieudathangTableMap::COL_TENNGUOINHAN, PhieudathangTableMap::COL_DIACHI, PhieudathangTableMap::COL_THANHPHO, PhieudathangTableMap::COL_QUAN_HUYEN, PhieudathangTableMap::COL_PHUONG_XA, PhieudathangTableMap::COL_CHIPHI, PhieudathangTableMap::COL_KHACHHANG_MAKH, PhieudathangTableMap::COL_TONGTIEN, PhieudathangTableMap::COL_NGAYGIAO, PhieudathangTableMap::COL_TINHTRANG, PhieudathangTableMap::COL_SODIENTHOAI, ),
        self::TYPE_FIELDNAME     => array('SoPhieu', 'NgayLap', 'TenNguoiNhan', 'DiaChi', 'ThanhPho', 'Quan_Huyen', 'Phuong_Xa', 'ChiPhi', 'KhachHang_MaKH', 'TongTien', 'NgayGiao', 'TinhTrang', 'SoDienThoai', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Sophieu' => 0, 'Ngaylap' => 1, 'Tennguoinhan' => 2, 'Diachi' => 3, 'Thanhpho' => 4, 'QuanHuyen' => 5, 'PhuongXa' => 6, 'Chiphi' => 7, 'KhachhangMakh' => 8, 'Tongtien' => 9, 'Ngaygiao' => 10, 'Tinhtrang' => 11, 'Sodienthoai' => 12, ),
        self::TYPE_CAMELNAME     => array('sophieu' => 0, 'ngaylap' => 1, 'tennguoinhan' => 2, 'diachi' => 3, 'thanhpho' => 4, 'quanHuyen' => 5, 'phuongXa' => 6, 'chiphi' => 7, 'khachhangMakh' => 8, 'tongtien' => 9, 'ngaygiao' => 10, 'tinhtrang' => 11, 'sodienthoai' => 12, ),
        self::TYPE_COLNAME       => array(PhieudathangTableMap::COL_SOPHIEU => 0, PhieudathangTableMap::COL_NGAYLAP => 1, PhieudathangTableMap::COL_TENNGUOINHAN => 2, PhieudathangTableMap::COL_DIACHI => 3, PhieudathangTableMap::COL_THANHPHO => 4, PhieudathangTableMap::COL_QUAN_HUYEN => 5, PhieudathangTableMap::COL_PHUONG_XA => 6, PhieudathangTableMap::COL_CHIPHI => 7, PhieudathangTableMap::COL_KHACHHANG_MAKH => 8, PhieudathangTableMap::COL_TONGTIEN => 9, PhieudathangTableMap::COL_NGAYGIAO => 10, PhieudathangTableMap::COL_TINHTRANG => 11, PhieudathangTableMap::COL_SODIENTHOAI => 12, ),
        self::TYPE_FIELDNAME     => array('SoPhieu' => 0, 'NgayLap' => 1, 'TenNguoiNhan' => 2, 'DiaChi' => 3, 'ThanhPho' => 4, 'Quan_Huyen' => 5, 'Phuong_Xa' => 6, 'ChiPhi' => 7, 'KhachHang_MaKH' => 8, 'TongTien' => 9, 'NgayGiao' => 10, 'TinhTrang' => 11, 'SoDienThoai' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('PhieuDatHang');
        $this->setPhpName('Phieudathang');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Phieudathang');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('SoPhieu', 'Sophieu', 'INTEGER', true, null, null);
        $this->addColumn('NgayLap', 'Ngaylap', 'TIMESTAMP', true, null, null);
        $this->addColumn('TenNguoiNhan', 'Tennguoinhan', 'VARCHAR', true, 30, null);
        $this->addColumn('DiaChi', 'Diachi', 'VARCHAR', true, 30, null);
        $this->addColumn('ThanhPho', 'Thanhpho', 'CHAR', true, 25, null);
        $this->addColumn('Quan_Huyen', 'QuanHuyen', 'VARCHAR', true, 30, null);
        $this->addColumn('Phuong_Xa', 'PhuongXa', 'VARCHAR', true, 30, null);
        $this->addColumn('ChiPhi', 'Chiphi', 'DECIMAL', true, 15, null);
        $this->addForeignKey('KhachHang_MaKH', 'KhachhangMakh', 'INTEGER', 'KhachHang', 'MaKH', false, null, null);
        $this->addColumn('TongTien', 'Tongtien', 'DECIMAL', true, 15, null);
        $this->addColumn('NgayGiao', 'Ngaygiao', 'TIMESTAMP', false, null, null);
        $this->addColumn('TinhTrang', 'Tinhtrang', 'BOOLEAN', true, 1, false);
        $this->addColumn('SoDienThoai', 'Sodienthoai', 'CHAR', true, 15, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Khachhang', '\\Model\\Khachhang', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':KhachHang_MaKH',
    1 => ':MaKH',
  ),
), null, null, null, false);
        $this->addRelation('Ctpdh', '\\Model\\Ctpdh', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PhieuDatHang_SoPhieu',
    1 => ':SoPhieu',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Sophieu', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PhieudathangTableMap::CLASS_DEFAULT : PhieudathangTableMap::OM_CLASS;
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
     * @return array           (Phieudathang object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PhieudathangTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PhieudathangTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PhieudathangTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PhieudathangTableMap::OM_CLASS;
            /** @var Phieudathang $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PhieudathangTableMap::addInstanceToPool($obj, $key);
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
            $key = PhieudathangTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PhieudathangTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Phieudathang $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PhieudathangTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PhieudathangTableMap::COL_SOPHIEU);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_NGAYLAP);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_TENNGUOINHAN);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_DIACHI);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_THANHPHO);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_QUAN_HUYEN);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_PHUONG_XA);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_CHIPHI);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_KHACHHANG_MAKH);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_TONGTIEN);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_NGAYGIAO);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_TINHTRANG);
            $criteria->addSelectColumn(PhieudathangTableMap::COL_SODIENTHOAI);
        } else {
            $criteria->addSelectColumn($alias . '.SoPhieu');
            $criteria->addSelectColumn($alias . '.NgayLap');
            $criteria->addSelectColumn($alias . '.TenNguoiNhan');
            $criteria->addSelectColumn($alias . '.DiaChi');
            $criteria->addSelectColumn($alias . '.ThanhPho');
            $criteria->addSelectColumn($alias . '.Quan_Huyen');
            $criteria->addSelectColumn($alias . '.Phuong_Xa');
            $criteria->addSelectColumn($alias . '.ChiPhi');
            $criteria->addSelectColumn($alias . '.KhachHang_MaKH');
            $criteria->addSelectColumn($alias . '.TongTien');
            $criteria->addSelectColumn($alias . '.NgayGiao');
            $criteria->addSelectColumn($alias . '.TinhTrang');
            $criteria->addSelectColumn($alias . '.SoDienThoai');
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
        return Propel::getServiceContainer()->getDatabaseMap(PhieudathangTableMap::DATABASE_NAME)->getTable(PhieudathangTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PhieudathangTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PhieudathangTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PhieudathangTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Phieudathang or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Phieudathang object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Phieudathang) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PhieudathangTableMap::DATABASE_NAME);
            $criteria->add(PhieudathangTableMap::COL_SOPHIEU, (array) $values, Criteria::IN);
        }

        $query = PhieudathangQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PhieudathangTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PhieudathangTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the PhieuDatHang table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PhieudathangQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Phieudathang or Criteria object.
     *
     * @param mixed               $criteria Criteria or Phieudathang object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Phieudathang object
        }

        if ($criteria->containsKey(PhieudathangTableMap::COL_SOPHIEU) && $criteria->keyContainsValue(PhieudathangTableMap::COL_SOPHIEU) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PhieudathangTableMap::COL_SOPHIEU.')');
        }


        // Set the correct dbName
        $query = PhieudathangQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PhieudathangTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PhieudathangTableMap::buildTableMap();
