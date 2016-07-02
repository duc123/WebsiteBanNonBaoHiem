<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Thanhpho as ChildThanhpho;
use Model\ThanhphoQuery as ChildThanhphoQuery;
use Model\Map\ThanhphoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ThanhPho' table.
 *
 *
 *
 * @method     ChildThanhphoQuery orderByMatp($order = Criteria::ASC) Order by the MaTP column
 * @method     ChildThanhphoQuery orderByTentp($order = Criteria::ASC) Order by the TenTP column
 *
 * @method     ChildThanhphoQuery groupByMatp() Group by the MaTP column
 * @method     ChildThanhphoQuery groupByTentp() Group by the TenTP column
 *
 * @method     ChildThanhphoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildThanhphoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildThanhphoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildThanhphoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildThanhphoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildThanhphoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildThanhphoQuery leftJoinQuanHuyen($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuanHuyen relation
 * @method     ChildThanhphoQuery rightJoinQuanHuyen($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuanHuyen relation
 * @method     ChildThanhphoQuery innerJoinQuanHuyen($relationAlias = null) Adds a INNER JOIN clause to the query using the QuanHuyen relation
 *
 * @method     ChildThanhphoQuery joinWithQuanHuyen($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuanHuyen relation
 *
 * @method     ChildThanhphoQuery leftJoinWithQuanHuyen() Adds a LEFT JOIN clause and with to the query using the QuanHuyen relation
 * @method     ChildThanhphoQuery rightJoinWithQuanHuyen() Adds a RIGHT JOIN clause and with to the query using the QuanHuyen relation
 * @method     ChildThanhphoQuery innerJoinWithQuanHuyen() Adds a INNER JOIN clause and with to the query using the QuanHuyen relation
 *
 * @method     \Model\QuanHuyenQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildThanhpho findOne(ConnectionInterface $con = null) Return the first ChildThanhpho matching the query
 * @method     ChildThanhpho findOneOrCreate(ConnectionInterface $con = null) Return the first ChildThanhpho matching the query, or a new ChildThanhpho object populated from the query conditions when no match is found
 *
 * @method     ChildThanhpho findOneByMatp(int $MaTP) Return the first ChildThanhpho filtered by the MaTP column
 * @method     ChildThanhpho findOneByTentp(string $TenTP) Return the first ChildThanhpho filtered by the TenTP column *

 * @method     ChildThanhpho requirePk($key, ConnectionInterface $con = null) Return the ChildThanhpho by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildThanhpho requireOne(ConnectionInterface $con = null) Return the first ChildThanhpho matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildThanhpho requireOneByMatp(int $MaTP) Return the first ChildThanhpho filtered by the MaTP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildThanhpho requireOneByTentp(string $TenTP) Return the first ChildThanhpho filtered by the TenTP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildThanhpho[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildThanhpho objects based on current ModelCriteria
 * @method     ChildThanhpho[]|ObjectCollection findByMatp(int $MaTP) Return ChildThanhpho objects filtered by the MaTP column
 * @method     ChildThanhpho[]|ObjectCollection findByTentp(string $TenTP) Return ChildThanhpho objects filtered by the TenTP column
 * @method     ChildThanhpho[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ThanhphoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ThanhphoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Thanhpho', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildThanhphoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildThanhphoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildThanhphoQuery) {
            return $criteria;
        }
        $query = new ChildThanhphoQuery();
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
     * @return ChildThanhpho|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ThanhphoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ThanhphoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildThanhpho A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaTP, TenTP FROM ThanhPho WHERE MaTP = :p0';
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
            /** @var ChildThanhpho $obj */
            $obj = new ChildThanhpho();
            $obj->hydrate($row);
            ThanhphoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildThanhpho|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaTP column
     *
     * Example usage:
     * <code>
     * $query->filterByMatp(1234); // WHERE MaTP = 1234
     * $query->filterByMatp(array(12, 34)); // WHERE MaTP IN (12, 34)
     * $query->filterByMatp(array('min' => 12)); // WHERE MaTP > 12
     * </code>
     *
     * @param     mixed $matp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
     */
    public function filterByMatp($matp = null, $comparison = null)
    {
        if (is_array($matp)) {
            $useMinMax = false;
            if (isset($matp['min'])) {
                $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $matp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($matp['max'])) {
                $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $matp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $matp, $comparison);
    }

    /**
     * Filter the query on the TenTP column
     *
     * Example usage:
     * <code>
     * $query->filterByTentp('fooValue');   // WHERE TenTP = 'fooValue'
     * $query->filterByTentp('%fooValue%'); // WHERE TenTP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tentp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
     */
    public function filterByTentp($tentp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tentp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tentp)) {
                $tentp = str_replace('*', '%', $tentp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ThanhphoTableMap::COL_TENTP, $tentp, $comparison);
    }

    /**
     * Filter the query by a related \Model\QuanHuyen object
     *
     * @param \Model\QuanHuyen|ObjectCollection $quanHuyen the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildThanhphoQuery The current query, for fluid interface
     */
    public function filterByQuanHuyen($quanHuyen, $comparison = null)
    {
        if ($quanHuyen instanceof \Model\QuanHuyen) {
            return $this
                ->addUsingAlias(ThanhphoTableMap::COL_MATP, $quanHuyen->getThanhphoMatp(), $comparison);
        } elseif ($quanHuyen instanceof ObjectCollection) {
            return $this
                ->useQuanHuyenQuery()
                ->filterByPrimaryKeys($quanHuyen->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
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
     * @param   ChildThanhpho $thanhpho Object to remove from the list of results
     *
     * @return $this|ChildThanhphoQuery The current query, for fluid interface
     */
    public function prune($thanhpho = null)
    {
        if ($thanhpho) {
            $this->addUsingAlias(ThanhphoTableMap::COL_MATP, $thanhpho->getMatp(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ThanhPho table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ThanhphoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ThanhphoTableMap::clearInstancePool();
            ThanhphoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ThanhphoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ThanhphoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ThanhphoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ThanhphoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ThanhphoQuery
