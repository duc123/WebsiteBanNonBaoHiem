<?php

namespace Model\Map;

use Model\Khachhang;
use Model\KhachhangQuery;
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
 * This class defines the structure of the 'KhachHang' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class KhachhangTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.KhachhangTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quanlybanhang';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'KhachHang';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Khachhang';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Khachhang';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the MaKH field
     */
    const COL_MAKH = 'KhachHang.MaKH';

    /**
     * the column name for the TenKH field
     */
    const COL_TENKH = 'KhachHang.TenKH';

    /**
     * the column name for the DT field
     */
    const COL_DT = 'KhachHang.DT';

    /**
     * the column name for the Email field
     */
    const COL_EMAIL = 'KhachHang.Email';

    /**
     * the column name for the DiaChi field
     */
    const COL_DIACHI = 'KhachHang.DiaChi';

    /**
     * the column name for the ThanhPho field
     */
    const COL_THANHPHO = 'KhachHang.ThanhPho';

    /**
     * the column name for the Quan_Huyen field
     */
    const COL_QUAN_HUYEN = 'KhachHang.Quan_Huyen';

    /**
     * the column name for the Phuong_Xa field
     */
    const COL_PHUONG_XA = 'KhachHang.Phuong_Xa';

    /**
     * the column name for the UserName field
     */
    const COL_USERNAME = 'KhachHang.UserName';

    /**
     * the column name for the Password field
     */
    const COL_PASSWORD = 'KhachHang.Password';

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
        self::TYPE_PHPNAME       => array('Makh', 'Tenkh', 'Dt', 'Email', 'Diachi', 'Thanhpho', 'QuanHuyen', 'PhuongXa', 'Username', 'Password', ),
        self::TYPE_CAMELNAME     => array('makh', 'tenkh', 'dt', 'email', 'diachi', 'thanhpho', 'quanHuyen', 'phuongXa', 'username', 'password', ),
        self::TYPE_COLNAME       => array(KhachhangTableMap::COL_MAKH, KhachhangTableMap::COL_TENKH, KhachhangTableMap::COL_DT, KhachhangTableMap::COL_EMAIL, KhachhangTableMap::COL_DIACHI, KhachhangTableMap::COL_THANHPHO, KhachhangTableMap::COL_QUAN_HUYEN, KhachhangTableMap::COL_PHUONG_XA, KhachhangTableMap::COL_USERNAME, KhachhangTableMap::COL_PASSWORD, ),
        self::TYPE_FIELDNAME     => array('MaKH', 'TenKH', 'DT', 'Email', 'DiaChi', 'ThanhPho', 'Quan_Huyen', 'Phuong_Xa', 'UserName', 'Password', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Makh' => 0, 'Tenkh' => 1, 'Dt' => 2, 'Email' => 3, 'Diachi' => 4, 'Thanhpho' => 5, 'QuanHuyen' => 6, 'PhuongXa' => 7, 'Username' => 8, 'Password' => 9, ),
        self::TYPE_CAMELNAME     => array('makh' => 0, 'tenkh' => 1, 'dt' => 2, 'email' => 3, 'diachi' => 4, 'thanhpho' => 5, 'quanHuyen' => 6, 'phuongXa' => 7, 'username' => 8, 'password' => 9, ),
        self::TYPE_COLNAME       => array(KhachhangTableMap::COL_MAKH => 0, KhachhangTableMap::COL_TENKH => 1, KhachhangTableMap::COL_DT => 2, KhachhangTableMap::COL_EMAIL => 3, KhachhangTableMap::COL_DIACHI => 4, KhachhangTableMap::COL_THANHPHO => 5, KhachhangTableMap::COL_QUAN_HUYEN => 6, KhachhangTableMap::COL_PHUONG_XA => 7, KhachhangTableMap::COL_USERNAME => 8, KhachhangTableMap::COL_PASSWORD => 9, ),
        self::TYPE_FIELDNAME     => array('MaKH' => 0, 'TenKH' => 1, 'DT' => 2, 'Email' => 3, 'DiaChi' => 4, 'ThanhPho' => 5, 'Quan_Huyen' => 6, 'Phuong_Xa' => 7, 'UserName' => 8, 'Password' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('KhachHang');
        $this->setPhpName('Khachhang');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Khachhang');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MaKH', 'Makh', 'INTEGER', true, null, null);
        $this->addColumn('TenKH', 'Tenkh', 'VARCHAR', false, 30, null);
        $this->addColumn('DT', 'Dt', 'CHAR', false, 13, null);
        $this->addColumn('Email', 'Email', 'CHAR', true, 40, null);
        $this->addColumn('DiaChi', 'Diachi', 'VARCHAR', false, 45, null);
        $this->addColumn('ThanhPho', 'Thanhpho', 'VARCHAR', false, 20, null);
        $this->addColumn('Quan_Huyen', 'QuanHuyen', 'VARCHAR', false, 20, null);
        $this->addColumn('Phuong_Xa', 'PhuongXa', 'VARCHAR', false, 45, null);
        $this->addColumn('UserName', 'Username', 'VARCHAR', false, 45, null);
        $this->addColumn('Password', 'Password', 'VARCHAR', false, 100, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Phieudathang', '\\Model\\Phieudathang', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':KhachHang_MaKH',
    1 => ':MaKH',
  ),
), null, null, 'Phieudathangs', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Makh', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? KhachhangTableMap::CLASS_DEFAULT : KhachhangTableMap::OM_CLASS;
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
     * @return array           (Khachhang object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = KhachhangTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = KhachhangTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + KhachhangTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = KhachhangTableMap::OM_CLASS;
            /** @var Khachhang $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            KhachhangTableMap::addInstanceToPool($obj, $key);
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
            $key = KhachhangTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = KhachhangTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Khachhang $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                KhachhangTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(KhachhangTableMap::COL_MAKH);
            $criteria->addSelectColumn(KhachhangTableMap::COL_TENKH);
            $criteria->addSelectColumn(KhachhangTableMap::COL_DT);
            $criteria->addSelectColumn(KhachhangTableMap::COL_EMAIL);
            $criteria->addSelectColumn(KhachhangTableMap::COL_DIACHI);
            $criteria->addSelectColumn(KhachhangTableMap::COL_THANHPHO);
            $criteria->addSelectColumn(KhachhangTableMap::COL_QUAN_HUYEN);
            $criteria->addSelectColumn(KhachhangTableMap::COL_PHUONG_XA);
            $criteria->addSelectColumn(KhachhangTableMap::COL_USERNAME);
            $criteria->addSelectColumn(KhachhangTableMap::COL_PASSWORD);
        } else {
            $criteria->addSelectColumn($alias . '.MaKH');
            $criteria->addSelectColumn($alias . '.TenKH');
            $criteria->addSelectColumn($alias . '.DT');
            $criteria->addSelectColumn($alias . '.Email');
            $criteria->addSelectColumn($alias . '.DiaChi');
            $criteria->addSelectColumn($alias . '.ThanhPho');
            $criteria->addSelectColumn($alias . '.Quan_Huyen');
            $criteria->addSelectColumn($alias . '.Phuong_Xa');
            $criteria->addSelectColumn($alias . '.UserName');
            $criteria->addSelectColumn($alias . '.Password');
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
        return Propel::getServiceContainer()->getDatabaseMap(KhachhangTableMap::DATABASE_NAME)->getTable(KhachhangTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(KhachhangTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(KhachhangTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new KhachhangTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Khachhang or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Khachhang object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Khachhang) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(KhachhangTableMap::DATABASE_NAME);
            $criteria->add(KhachhangTableMap::COL_MAKH, (array) $values, Criteria::IN);
        }

        $query = KhachhangQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            KhachhangTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                KhachhangTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the KhachHang table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return KhachhangQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Khachhang or Criteria object.
     *
     * @param mixed               $criteria Criteria or Khachhang object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Khachhang object
        }

        if ($criteria->containsKey(KhachhangTableMap::COL_MAKH) && $criteria->keyContainsValue(KhachhangTableMap::COL_MAKH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.KhachhangTableMap::COL_MAKH.')');
        }


        // Set the correct dbName
        $query = KhachhangQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // KhachhangTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
KhachhangTableMap::buildTableMap();
