<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\PhuongXa as ChildPhuongXa;
use Model\PhuongXaQuery as ChildPhuongXaQuery;
use Model\Map\PhuongXaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Phuong_Xa' table.
 *
 *
 *
 * @method     ChildPhuongXaQuery orderByMapX($order = Criteria::ASC) Order by the MaP_X column
 * @method     ChildPhuongXaQuery orderByTenpX($order = Criteria::ASC) Order by the TenP_X column
 * @method     ChildPhuongXaQuery orderByQuanHuyenMaquanHuyen($order = Criteria::ASC) Order by the Quan_Huyen_MaQuan_Huyen column
 *
 * @method     ChildPhuongXaQuery groupByMapX() Group by the MaP_X column
 * @method     ChildPhuongXaQuery groupByTenpX() Group by the TenP_X column
 * @method     ChildPhuongXaQuery groupByQuanHuyenMaquanHuyen() Group by the Quan_Huyen_MaQuan_Huyen column
 *
 * @method     ChildPhuongXaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPhuongXaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPhuongXaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPhuongXaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPhuongXaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPhuongXaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPhuongXaQuery leftJoinQuanHuyen($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuanHuyen relation
 * @method     ChildPhuongXaQuery rightJoinQuanHuyen($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuanHuyen relation
 * @method     ChildPhuongXaQuery innerJoinQuanHuyen($relationAlias = null) Adds a INNER JOIN clause to the query using the QuanHuyen relation
 *
 * @method     ChildPhuongXaQuery joinWithQuanHuyen($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuanHuyen relation
 *
 * @method     ChildPhuongXaQuery leftJoinWithQuanHuyen() Adds a LEFT JOIN clause and with to the query using the QuanHuyen relation
 * @method     ChildPhuongXaQuery rightJoinWithQuanHuyen() Adds a RIGHT JOIN clause and with to the query using the QuanHuyen relation
 * @method     ChildPhuongXaQuery innerJoinWithQuanHuyen() Adds a INNER JOIN clause and with to the query using the QuanHuyen relation
 *
 * @method     \Model\QuanHuyenQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPhuongXa findOne(ConnectionInterface $con = null) Return the first ChildPhuongXa matching the query
 * @method     ChildPhuongXa findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPhuongXa matching the query, or a new ChildPhuongXa object populated from the query conditions when no match is found
 *
 * @method     ChildPhuongXa findOneByMapX(int $MaP_X) Return the first ChildPhuongXa filtered by the MaP_X column
 * @method     ChildPhuongXa findOneByTenpX(string $TenP_X) Return the first ChildPhuongXa filtered by the TenP_X column
 * @method     ChildPhuongXa findOneByQuanHuyenMaquanHuyen(int $Quan_Huyen_MaQuan_Huyen) Return the first ChildPhuongXa filtered by the Quan_Huyen_MaQuan_Huyen column *

 * @method     ChildPhuongXa requirePk($key, ConnectionInterface $con = null) Return the ChildPhuongXa by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhuongXa requireOne(ConnectionInterface $con = null) Return the first ChildPhuongXa matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhuongXa requireOneByMapX(int $MaP_X) Return the first ChildPhuongXa filtered by the MaP_X column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhuongXa requireOneByTenpX(string $TenP_X) Return the first ChildPhuongXa filtered by the TenP_X column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhuongXa requireOneByQuanHuyenMaquanHuyen(int $Quan_Huyen_MaQuan_Huyen) Return the first ChildPhuongXa filtered by the Quan_Huyen_MaQuan_Huyen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhuongXa[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPhuongXa objects based on current ModelCriteria
 * @method     ChildPhuongXa[]|ObjectCollection findByMapX(int $MaP_X) Return ChildPhuongXa objects filtered by the MaP_X column
 * @method     ChildPhuongXa[]|ObjectCollection findByTenpX(string $TenP_X) Return ChildPhuongXa objects filtered by the TenP_X column
 * @method     ChildPhuongXa[]|ObjectCollection findByQuanHuyenMaquanHuyen(int $Quan_Huyen_MaQuan_Huyen) Return ChildPhuongXa objects filtered by the Quan_Huyen_MaQuan_Huyen column
 * @method     ChildPhuongXa[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PhuongXaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\PhuongXaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\PhuongXa', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPhuongXaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPhuongXaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPhuongXaQuery) {
            return $criteria;
        }
        $query = new ChildPhuongXaQuery();
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
     * @return ChildPhuongXa|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PhuongXaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PhuongXaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPhuongXa A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaP_X, TenP_X, Quan_Huyen_MaQuan_Huyen FROM Phuong_Xa WHERE MaP_X = :p0';
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
            /** @var ChildPhuongXa $obj */
            $obj = new ChildPhuongXa();
            $obj->hydrate($row);
            PhuongXaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPhuongXa|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaP_X column
     *
     * Example usage:
     * <code>
     * $query->filterByMapX(1234); // WHERE MaP_X = 1234
     * $query->filterByMapX(array(12, 34)); // WHERE MaP_X IN (12, 34)
     * $query->filterByMapX(array('min' => 12)); // WHERE MaP_X > 12
     * </code>
     *
     * @param     mixed $mapX The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByMapX($mapX = null, $comparison = null)
    {
        if (is_array($mapX)) {
            $useMinMax = false;
            if (isset($mapX['min'])) {
                $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $mapX['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mapX['max'])) {
                $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $mapX['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $mapX, $comparison);
    }

    /**
     * Filter the query on the TenP_X column
     *
     * Example usage:
     * <code>
     * $query->filterByTenpX('fooValue');   // WHERE TenP_X = 'fooValue'
     * $query->filterByTenpX('%fooValue%'); // WHERE TenP_X LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenpX The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByTenpX($tenpX = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenpX)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tenpX)) {
                $tenpX = str_replace('*', '%', $tenpX);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhuongXaTableMap::COL_TENP_X, $tenpX, $comparison);
    }

    /**
     * Filter the query on the Quan_Huyen_MaQuan_Huyen column
     *
     * Example usage:
     * <code>
     * $query->filterByQuanHuyenMaquanHuyen(1234); // WHERE Quan_Huyen_MaQuan_Huyen = 1234
     * $query->filterByQuanHuyenMaquanHuyen(array(12, 34)); // WHERE Quan_Huyen_MaQuan_Huyen IN (12, 34)
     * $query->filterByQuanHuyenMaquanHuyen(array('min' => 12)); // WHERE Quan_Huyen_MaQuan_Huyen > 12
     * </code>
     *
     * @see       filterByQuanHuyen()
     *
     * @param     mixed $quanHuyenMaquanHuyen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByQuanHuyenMaquanHuyen($quanHuyenMaquanHuyen = null, $comparison = null)
    {
        if (is_array($quanHuyenMaquanHuyen)) {
            $useMinMax = false;
            if (isset($quanHuyenMaquanHuyen['min'])) {
                $this->addUsingAlias(PhuongXaTableMap::COL_QUAN_HUYEN_MAQUAN_HUYEN, $quanHuyenMaquanHuyen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quanHuyenMaquanHuyen['max'])) {
                $this->addUsingAlias(PhuongXaTableMap::COL_QUAN_HUYEN_MAQUAN_HUYEN, $quanHuyenMaquanHuyen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhuongXaTableMap::COL_QUAN_HUYEN_MAQUAN_HUYEN, $quanHuyenMaquanHuyen, $comparison);
    }

    /**
     * Filter the query by a related \Model\QuanHuyen object
     *
     * @param \Model\QuanHuyen|ObjectCollection $quanHuyen The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPhuongXaQuery The current query, for fluid interface
     */
    public function filterByQuanHuyen($quanHuyen, $comparison = null)
    {
        if ($quanHuyen instanceof \Model\QuanHuyen) {
            return $this
                ->addUsingAlias(PhuongXaTableMap::COL_QUAN_HUYEN_MAQUAN_HUYEN, $quanHuyen->getMaquanHuyen(), $comparison);
        } elseif ($quanHuyen instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PhuongXaTableMap::COL_QUAN_HUYEN_MAQUAN_HUYEN, $quanHuyen->toKeyValue('PrimaryKey', 'MaquanHuyen'), $comparison);
        } else {
            throw new PropelException('filterByQuanHuyen() only accepts arguments of type \Model\QuanHuyen or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the QuanHuyen relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function joinQuanHuyen($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('QuanHuyen');

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
            $this->addJoinObject($join, 'QuanHuyen');
        }

        return $this;
    }

    /**
     * Use the QuanHuyen relation QuanHuyen object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\QuanHuyenQuery A secondary query class using the current class as primary query
     */
    public function useQuanHuyenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinQuanHuyen($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'QuanHuyen', '\Model\QuanHuyenQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPhuongXa $phuongXa Object to remove from the list of results
     *
     * @return $this|ChildPhuongXaQuery The current query, for fluid interface
     */
    public function prune($phuongXa = null)
    {
        if ($phuongXa) {
            $this->addUsingAlias(PhuongXaTableMap::COL_MAP_X, $phuongXa->getMapX(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Phuong_Xa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhuongXaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PhuongXaTableMap::clearInstancePool();
            PhuongXaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PhuongXaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PhuongXaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PhuongXaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PhuongXaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PhuongXaQuery
