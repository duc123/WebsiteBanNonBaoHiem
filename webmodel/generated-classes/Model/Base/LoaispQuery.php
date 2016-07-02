<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Loaisp as ChildLoaisp;
use Model\LoaispQuery as ChildLoaispQuery;
use Model\Map\LoaispTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'LoaiSP' table.
 *
 *
 *
 * @method     ChildLoaispQuery orderByMaloaisp($order = Criteria::ASC) Order by the MaLoaiSP column
 * @method     ChildLoaispQuery orderByTenloaisp($order = Criteria::ASC) Order by the TenLoaiSP column
 * @method     ChildLoaispQuery orderByDanhmucMadm($order = Criteria::ASC) Order by the DanhMuc_MaDM column
 *
 * @method     ChildLoaispQuery groupByMaloaisp() Group by the MaLoaiSP column
 * @method     ChildLoaispQuery groupByTenloaisp() Group by the TenLoaiSP column
 * @method     ChildLoaispQuery groupByDanhmucMadm() Group by the DanhMuc_MaDM column
 *
 * @method     ChildLoaispQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoaispQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoaispQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoaispQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoaispQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoaispQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoaispQuery leftJoinDanhmuc($relationAlias = null) Adds a LEFT JOIN clause to the query using the Danhmuc relation
 * @method     ChildLoaispQuery rightJoinDanhmuc($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Danhmuc relation
 * @method     ChildLoaispQuery innerJoinDanhmuc($relationAlias = null) Adds a INNER JOIN clause to the query using the Danhmuc relation
 *
 * @method     ChildLoaispQuery joinWithDanhmuc($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Danhmuc relation
 *
 * @method     ChildLoaispQuery leftJoinWithDanhmuc() Adds a LEFT JOIN clause and with to the query using the Danhmuc relation
 * @method     ChildLoaispQuery rightJoinWithDanhmuc() Adds a RIGHT JOIN clause and with to the query using the Danhmuc relation
 * @method     ChildLoaispQuery innerJoinWithDanhmuc() Adds a INNER JOIN clause and with to the query using the Danhmuc relation
 *
 * @method     ChildLoaispQuery leftJoinSanpham($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sanpham relation
 * @method     ChildLoaispQuery rightJoinSanpham($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sanpham relation
 * @method     ChildLoaispQuery innerJoinSanpham($relationAlias = null) Adds a INNER JOIN clause to the query using the Sanpham relation
 *
 * @method     ChildLoaispQuery joinWithSanpham($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Sanpham relation
 *
 * @method     ChildLoaispQuery leftJoinWithSanpham() Adds a LEFT JOIN clause and with to the query using the Sanpham relation
 * @method     ChildLoaispQuery rightJoinWithSanpham() Adds a RIGHT JOIN clause and with to the query using the Sanpham relation
 * @method     ChildLoaispQuery innerJoinWithSanpham() Adds a INNER JOIN clause and with to the query using the Sanpham relation
 *
 * @method     \Model\DanhmucQuery|\Model\SanphamQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoaisp findOne(ConnectionInterface $con = null) Return the first ChildLoaisp matching the query
 * @method     ChildLoaisp findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoaisp matching the query, or a new ChildLoaisp object populated from the query conditions when no match is found
 *
 * @method     ChildLoaisp findOneByMaloaisp(int $MaLoaiSP) Return the first ChildLoaisp filtered by the MaLoaiSP column
 * @method     ChildLoaisp findOneByTenloaisp(string $TenLoaiSP) Return the first ChildLoaisp filtered by the TenLoaiSP column
 * @method     ChildLoaisp findOneByDanhmucMadm(int $DanhMuc_MaDM) Return the first ChildLoaisp filtered by the DanhMuc_MaDM column *

 * @method     ChildLoaisp requirePk($key, ConnectionInterface $con = null) Return the ChildLoaisp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoaisp requireOne(ConnectionInterface $con = null) Return the first ChildLoaisp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoaisp requireOneByMaloaisp(int $MaLoaiSP) Return the first ChildLoaisp filtered by the MaLoaiSP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoaisp requireOneByTenloaisp(string $TenLoaiSP) Return the first ChildLoaisp filtered by the TenLoaiSP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoaisp requireOneByDanhmucMadm(int $DanhMuc_MaDM) Return the first ChildLoaisp filtered by the DanhMuc_MaDM column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoaisp[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoaisp objects based on current ModelCriteria
 * @method     ChildLoaisp[]|ObjectCollection findByMaloaisp(int $MaLoaiSP) Return ChildLoaisp objects filtered by the MaLoaiSP column
 * @method     ChildLoaisp[]|ObjectCollection findByTenloaisp(string $TenLoaiSP) Return ChildLoaisp objects filtered by the TenLoaiSP column
 * @method     ChildLoaisp[]|ObjectCollection findByDanhmucMadm(int $DanhMuc_MaDM) Return ChildLoaisp objects filtered by the DanhMuc_MaDM column
 * @method     ChildLoaisp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoaispQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\LoaispQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Loaisp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoaispQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoaispQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoaispQuery) {
            return $criteria;
        }
        $query = new ChildLoaispQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildLoaisp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoaispTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoaispTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoaisp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaLoaiSP, TenLoaiSP, DanhMuc_MaDM FROM LoaiSP WHERE MaLoaiSP = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildLoaisp $obj */
            $obj = new ChildLoaisp();
            $obj->hydrate($row);
            LoaispTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildLoaisp|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaLoaiSP column
     *
     * Example usage:
     * <code>
     * $query->filterByMaloaisp(1234); // WHERE MaLoaiSP = 1234
     * $query->filterByMaloaisp(array(12, 34)); // WHERE MaLoaiSP IN (12, 34)
     * $query->filterByMaloaisp(array('min' => 12)); // WHERE MaLoaiSP > 12
     * </code>
     *
     * @param     mixed $maloaisp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByMaloaisp($maloaisp = null, $comparison = null)
    {
        if (is_array($maloaisp)) {
            $useMinMax = false;
            if (isset($maloaisp['min'])) {
                $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $maloaisp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maloaisp['max'])) {
                $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $maloaisp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $maloaisp, $comparison);
    }

    /**
     * Filter the query on the TenLoaiSP column
     *
     * Example usage:
     * <code>
     * $query->filterByTenloaisp('fooValue');   // WHERE TenLoaiSP = 'fooValue'
     * $query->filterByTenloaisp('%fooValue%'); // WHERE TenLoaiSP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenloaisp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByTenloaisp($tenloaisp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenloaisp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tenloaisp)) {
                $tenloaisp = str_replace('*', '%', $tenloaisp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LoaispTableMap::COL_TENLOAISP, $tenloaisp, $comparison);
    }

    /**
     * Filter the query on the DanhMuc_MaDM column
     *
     * Example usage:
     * <code>
     * $query->filterByDanhmucMadm(1234); // WHERE DanhMuc_MaDM = 1234
     * $query->filterByDanhmucMadm(array(12, 34)); // WHERE DanhMuc_MaDM IN (12, 34)
     * $query->filterByDanhmucMadm(array('min' => 12)); // WHERE DanhMuc_MaDM > 12
     * </code>
     *
     * @see       filterByDanhmuc()
     *
     * @param     mixed $danhmucMadm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByDanhmucMadm($danhmucMadm = null, $comparison = null)
    {
        if (is_array($danhmucMadm)) {
            $useMinMax = false;
            if (isset($danhmucMadm['min'])) {
                $this->addUsingAlias(LoaispTableMap::COL_DANHMUC_MADM, $danhmucMadm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($danhmucMadm['max'])) {
                $this->addUsingAlias(LoaispTableMap::COL_DANHMUC_MADM, $danhmucMadm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoaispTableMap::COL_DANHMUC_MADM, $danhmucMadm, $comparison);
    }

    /**
     * Filter the query by a related \Model\Danhmuc object
     *
     * @param \Model\Danhmuc|ObjectCollection $danhmuc The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoaispQuery The current query, for fluid interface
     */
    public function filterByDanhmuc($danhmuc, $comparison = null)
    {
        if ($danhmuc instanceof \Model\Danhmuc) {
            return $this
                ->addUsingAlias(LoaispTableMap::COL_DANHMUC_MADM, $danhmuc->getMadm(), $comparison);
        } elseif ($danhmuc instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LoaispTableMap::COL_DANHMUC_MADM, $danhmuc->toKeyValue('PrimaryKey', 'Madm'), $comparison);
        } else {
            throw new PropelException('filterByDanhmuc() only accepts arguments of type \Model\Danhmuc or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Danhmuc relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function joinDanhmuc($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Danhmuc');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Danhmuc');
        }

        return $this;
    }

    /**
     * Use the Danhmuc relation Danhmuc object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\DanhmucQuery A secondary query class using the current class as primary query
     */
    public function useDanhmucQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDanhmuc($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Danhmuc', '\Model\DanhmucQuery');
    }

    /**
     * Filter the query by a related \Model\Sanpham object
     *
     * @param \Model\Sanpham|ObjectCollection $sanpham the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLoaispQuery The current query, for fluid interface
     */
    public function filterBySanpham($sanpham, $comparison = null)
    {
        if ($sanpham instanceof \Model\Sanpham) {
            return $this
                ->addUsingAlias(LoaispTableMap::COL_MALOAISP, $sanpham->getLoaispMaloaisp(), $comparison);
        } elseif ($sanpham instanceof ObjectCollection) {
            return $this
                ->useSanphamQuery()
                ->filterByPrimaryKeys($sanpham->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySanpham() only accepts arguments of type \Model\Sanpham or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sanpham relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function joinSanpham($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sanpham');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Sanpham');
        }

        return $this;
    }

    /**
     * Use the Sanpham relation Sanpham object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\SanphamQuery A secondary query class using the current class as primary query
     */
    public function useSanphamQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSanpham($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sanpham', '\Model\SanphamQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoaisp $loaisp Object to remove from the list of results
     *
     * @return $this|ChildLoaispQuery The current query, for fluid interface
     */
    public function prune($loaisp = null)
    {
        if ($loaisp) {
            $this->addUsingAlias(LoaispTableMap::COL_MALOAISP, $loaisp->getMaloaisp(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the LoaiSP table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoaispTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoaispTableMap::clearInstancePool();
            LoaispTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoaispTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoaispTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoaispTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoaispTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LoaispQuery
