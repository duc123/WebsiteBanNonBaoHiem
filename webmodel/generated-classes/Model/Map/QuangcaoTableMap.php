<?php

namespace Model\Map;

use Model\Quangcao;
use Model\QuangcaoQuery;
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
 * This class defines the structure of the 'QuangCao' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class QuangcaoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.QuangcaoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'quanlybanhang';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'QuangCao';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Quangcao';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Quangcao';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the MaQC field
     */
    const COL_MAQC = 'QuangCao.MaQC';

    /**
     * the column name for the TenQC field
     */
    const COL_TENQC = 'QuangCao.TenQC';

    /**
     * the column name for the NoiDung field
     */
    const COL_NOIDUNG = 'QuangCao.NoiDung';

    /**
     * the column name for the HinhAnh field
     */
    const COL_HINHANH = 'QuangCao.HinhAnh';

    /**
     * the column name for the LoaiQuangCao_MaLQC field
     */
    const COL_LOAIQUANGCAO_MALQC = 'QuangCao.LoaiQuangCao_MaLQC';

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
        self::TYPE_PHPNAME       => array('Maqc', 'Tenqc', 'Noidung', 'Hinhanh', 'LoaiquangcaoMalqc', ),
        self::TYPE_CAMELNAME     => array('maqc', 'tenqc', 'noidung', 'hinhanh', 'loaiquangcaoMalqc', ),
        self::TYPE_COLNAME       => array(QuangcaoTableMap::COL_MAQC, QuangcaoTableMap::COL_TENQC, QuangcaoTableMap::COL_NOIDUNG, QuangcaoTableMap::COL_HINHANH, QuangcaoTableMap::COL_LOAIQUANGCAO_MALQC, ),
        self::TYPE_FIELDNAME     => array('MaQC', 'TenQC', 'NoiDung', 'HinhAnh', 'LoaiQuangCao_MaLQC', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Maqc' => 0, 'Tenqc' => 1, 'Noidung' => 2, 'Hinhanh' => 3, 'LoaiquangcaoMalqc' => 4, ),
        self::TYPE_CAMELNAME     => array('maqc' => 0, 'tenqc' => 1, 'noidung' => 2, 'hinhanh' => 3, 'loaiquangcaoMalqc' => 4, ),
        self::TYPE_COLNAME       => array(QuangcaoTableMap::COL_MAQC => 0, QuangcaoTableMap::COL_TENQC => 1, QuangcaoTableMap::COL_NOIDUNG => 2, QuangcaoTableMap::COL_HINHANH => 3, QuangcaoTableMap::COL_LOAIQUANGCAO_MALQC => 4, ),
        self::TYPE_FIELDNAME     => array('MaQC' => 0, 'TenQC' => 1, 'NoiDung' => 2, 'HinhAnh' => 3, 'LoaiQuangCao_MaLQC' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('QuangCao');
        $this->setPhpName('Quangcao');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Quangcao');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MaQC', 'Maqc', 'INTEGER', true, null, null);
        $this->addColumn('TenQC', 'Tenqc', 'VARCHAR', true, 50, null);
        $this->addColumn('NoiDung', 'Noidung', 'LONGVARCHAR', false, null, null);
        $this->addColumn('HinhAnh', 'Hinhanh', 'VARCHAR', false, 40, null);
        $this->addForeignKey('LoaiQuangCao_MaLQC', 'LoaiquangcaoMalqc', 'INTEGER', 'LoaiQuangCao', 'MaLQC', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Loaiquangcao', '\\Model\\Loaiquangcao', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':LoaiQuangCao_MaLQC',
    1 => ':MaLQC',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Maqc', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? QuangcaoTableMap::CLASS_DEFAULT : QuangcaoTableMap::OM_CLASS;
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
     * @return array           (Quangcao object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = QuangcaoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = QuangcaoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + QuangcaoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = QuangcaoTableMap::OM_CLASS;
            /** @var Quangcao $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            QuangcaoTableMap::addInstanceToPool($obj, $key);
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
            $key = QuangcaoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = QuangcaoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Quangcao $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                QuangcaoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(QuangcaoTableMap::COL_MAQC);
            $criteria->addSelectColumn(QuangcaoTableMap::COL_TENQC);
            $criteria->addSelectColumn(QuangcaoTableMap::COL_NOIDUNG);
            $criteria->addSelectColumn(QuangcaoTableMap::COL_HINHANH);
            $criteria->addSelectColumn(QuangcaoTableMap::COL_LOAIQUANGCAO_MALQC);
        } else {
            $criteria->addSelectColumn($alias . '.MaQC');
            $criteria->addSelectColumn($alias . '.TenQC');
            $criteria->addSelectColumn($alias . '.NoiDung');
            $criteria->addSelectColumn($alias . '.HinhAnh');
            $criteria->addSelectColumn($alias . '.LoaiQuangCao_MaLQC');
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
        return Propel::getServiceContainer()->getDatabaseMap(QuangcaoTableMap::DATABASE_NAME)->getTable(QuangcaoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(QuangcaoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(QuangcaoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new QuangcaoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Quangcao or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Quangcao object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuangcaoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Quangcao) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(QuangcaoTableMap::DATABASE_NAME);
            $criteria->add(QuangcaoTableMap::COL_MAQC, (array) $values, Criteria::IN);
        }

        $query = QuangcaoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            QuangcaoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                QuangcaoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the QuangCao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return QuangcaoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Quangcao or Criteria object.
     *
     * @param mixed               $criteria Criteria or Quangcao object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuangcaoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Quangcao object
        }

        if ($criteria->containsKey(QuangcaoTableMap::COL_MAQC) && $criteria->keyContainsValue(QuangcaoTableMap::COL_MAQC) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuangcaoTableMap::COL_MAQC.')');
        }


        // Set the correct dbName
        $query = QuangcaoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // QuangcaoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
QuangcaoTableMap::buildTableMap();
