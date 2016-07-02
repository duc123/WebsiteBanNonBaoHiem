<?php

namespace Model\Map;

use Model\QuanHuyen;
use Model\QuanHuyenQuery;
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
 * This class defines the structure of the 'Quan_Huyen' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class QuanHuyenTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.QuanHuyenTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quanlybanhang';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Quan_Huyen';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\QuanHuyen';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.QuanHuyen';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the MaQuan_Huyen field
     */
    const COL_MAQUAN_HUYEN = 'Quan_Huyen.MaQuan_Huyen';

    /**
     * the column name for the TenQuan_Huyen field
     */
    const COL_TENQUAN_HUYEN = 'Quan_Huyen.TenQuan_Huyen';

    /**
     * the column name for the ChiPhiGiaoHang field
     */
    const COL_CHIPHIGIAOHANG = 'Quan_Huyen.ChiPhiGiaoHang';

    /**
     * the column name for the ThanhPho_MaTP field
     */
    const COL_THANHPHO_MATP = 'Quan_Huyen.ThanhPho_MaTP';

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
        self::TYPE_PHPNAME       => array('MaquanHuyen', 'TenquanHuyen', 'Chiphigiaohang', 'ThanhphoMatp', ),
        self::TYPE_CAMELNAME     => array('maquanHuyen', 'tenquanHuyen', 'chiphigiaohang', 'thanhphoMatp', ),
        self::TYPE_COLNAME       => array(QuanHuyenTableMap::COL_MAQUAN_HUYEN, QuanHuyenTableMap::COL_TENQUAN_HUYEN, QuanHuyenTableMap::COL_CHIPHIGIAOHANG, QuanHuyenTableMap::COL_THANHPHO_MATP, ),
        self::TYPE_FIELDNAME     => array('MaQuan_Huyen', 'TenQuan_Huyen', 'ChiPhiGiaoHang', 'ThanhPho_MaTP', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('MaquanHuyen' => 0, 'TenquanHuyen' => 1, 'Chiphigiaohang' => 2, 'ThanhphoMatp' => 3, ),
        self::TYPE_CAMELNAME     => array('maquanHuyen' => 0, 'tenquanHuyen' => 1, 'chiphigiaohang' => 2, 'thanhphoMatp' => 3, ),
        self::TYPE_COLNAME       => array(QuanHuyenTableMap::COL_MAQUAN_HUYEN => 0, QuanHuyenTableMap::COL_TENQUAN_HUYEN => 1, QuanHuyenTableMap::COL_CHIPHIGIAOHANG => 2, QuanHuyenTableMap::COL_THANHPHO_MATP => 3, ),
        self::TYPE_FIELDNAME     => array('MaQuan_Huyen' => 0, 'TenQuan_Huyen' => 1, 'ChiPhiGiaoHang' => 2, 'ThanhPho_MaTP' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('Quan_Huyen');
        $this->setPhpName('QuanHuyen');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\QuanHuyen');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MaQuan_Huyen', 'MaquanHuyen', 'INTEGER', true, null, null);
        $this->addColumn('TenQuan_Huyen', 'TenquanHuyen', 'VARCHAR', true, 60, null);
        $this->addColumn('ChiPhiGiaoHang', 'Chiphigiaohang', 'DECIMAL', true, 15, null);
        $this->addForeignKey('ThanhPho_MaTP', 'ThanhphoMatp', 'INTEGER', 'ThanhPho', 'MaTP', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Thanhpho', '\\Model\\Thanhpho', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ThanhPho_MaTP',
    1 => ':MaTP',
  ),
), null, null, null, false);
        $this->addRelation('PhuongXa', '\\Model\\PhuongXa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':Quan_Huyen_MaQuan_Huyen',
    1 => ':MaQuan_Huyen',
  ),
), null, null, 'PhuongXas', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MaquanHuyen', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? QuanHuyenTableMap::CLASS_DEFAULT : QuanHuyenTableMap::OM_CLASS;
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
     * @return array           (QuanHuyen object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = QuanHuyenTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = QuanHuyenTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + QuanHuyenTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = QuanHuyenTableMap::OM_CLASS;
            /** @var QuanHuyen $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            QuanHuyenTableMap::addInstanceToPool($obj, $key);
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
            $key = QuanHuyenTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = QuanHuyenTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var QuanHuyen $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                QuanHuyenTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(QuanHuyenTableMap::COL_MAQUAN_HUYEN);
            $criteria->addSelectColumn(QuanHuyenTableMap::COL_TENQUAN_HUYEN);
            $criteria->addSelectColumn(QuanHuyenTableMap::COL_CHIPHIGIAOHANG);
            $criteria->addSelectColumn(QuanHuyenTableMap::COL_THANHPHO_MATP);
        } else {
            $criteria->addSelectColumn($alias . '.MaQuan_Huyen');
            $criteria->addSelectColumn($alias . '.TenQuan_Huyen');
            $criteria->addSelectColumn($alias . '.ChiPhiGiaoHang');
            $criteria->addSelectColumn($alias . '.ThanhPho_MaTP');
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
        return Propel::getServiceContainer()->getDatabaseMap(QuanHuyenTableMap::DATABASE_NAME)->getTable(QuanHuyenTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(QuanHuyenTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(QuanHuyenTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new QuanHuyenTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a QuanHuyen or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or QuanHuyen object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuanHuyenTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\QuanHuyen) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(QuanHuyenTableMap::DATABASE_NAME);
            $criteria->add(QuanHuyenTableMap::COL_MAQUAN_HUYEN, (array) $values, Criteria::IN);
        }

        $query = QuanHuyenQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            QuanHuyenTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                QuanHuyenTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Quan_Huyen table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return QuanHuyenQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a QuanHuyen or Criteria object.
     *
     * @param mixed               $criteria Criteria or QuanHuyen object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuanHuyenTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from QuanHuyen object
        }

        if ($criteria->containsKey(QuanHuyenTableMap::COL_MAQUAN_HUYEN) && $criteria->keyContainsValue(QuanHuyenTableMap::COL_MAQUAN_HUYEN) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuanHuyenTableMap::COL_MAQUAN_HUYEN.')');
        }


        // Set the correct dbName
        $query = QuanHuyenQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // QuanHuyenTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
QuanHuyenTableMap::buildTableMap();
