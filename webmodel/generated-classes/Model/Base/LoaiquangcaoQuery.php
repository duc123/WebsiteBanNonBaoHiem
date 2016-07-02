<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Loaiquangcao as ChildLoaiquangcao;
use Model\LoaiquangcaoQuery as ChildLoaiquangcaoQuery;
use Model\Map\LoaiquangcaoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'LoaiQuangCao' table.
 *
 *
 *
 * @method     ChildLoaiquangcaoQuery orderByMalqc($order = Criteria::ASC) Order by the MaLQC column
 * @method     ChildLoaiquangcaoQuery orderByTenlqc($order = Criteria::ASC) Order by the TenLQC column
 *
 * @method     ChildLoaiquangcaoQuery groupByMalqc() Group by the MaLQC column
 * @method     ChildLoaiquangcaoQuery groupByTenlqc() Group by the TenLQC column
 *
 * @method     ChildLoaiquangcaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoaiquangcaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoaiquangcaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoaiquangcaoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLoaiquangcaoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLoaiquangcaoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLoaiquangcaoQuery leftJoinQuangcao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Quangcao relation
 * @method     ChildLoaiquangcaoQuery rightJoinQuangcao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Quangcao relation
 * @method     ChildLoaiquangcaoQuery innerJoinQuangcao($relationAlias = null) Adds a INNER JOIN clause to the query using the Quangcao relation
 *
 * @method     ChildLoaiquangcaoQuery joinWithQuangcao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Quangcao relation
 *
 * @method     ChildLoaiquangcaoQuery leftJoinWithQuangcao() Adds a LEFT JOIN clause and with to the query using the Quangcao relation
 * @method     ChildLoaiquangcaoQuery rightJoinWithQuangcao() Adds a RIGHT JOIN clause and with to the query using the Quangcao relation
 * @method     ChildLoaiquangcaoQuery innerJoinWithQuangcao() Adds a INNER JOIN clause and with to the query using the Quangcao relation
 *
 * @method     \Model\QuangcaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoaiquangcao findOne(ConnectionInterface $con = null) Return the first ChildLoaiquangcao matching the query
 * @method     ChildLoaiquangcao findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoaiquangcao matching the query, or a new ChildLoaiquangcao object populated from the query conditions when no match is found
 *
 * @method     ChildLoaiquangcao findOneByMalqc(int $MaLQC) Return the first ChildLoaiquangcao filtered by the MaLQC column
 * @method     ChildLoaiquangcao findOneByTenlqc(string $TenLQC) Return the first ChildLoaiquangcao filtered by the TenLQC column *

 * @method     ChildLoaiquangcao requirePk($key, ConnectionInterface $con = null) Return the ChildLoaiquangcao by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoaiquangcao requireOne(ConnectionInterface $con = null) Return the first ChildLoaiquangcao matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoaiquangcao requireOneByMalqc(int $MaLQC) Return the first ChildLoaiquangcao filtered by the MaLQC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoaiquangcao requireOneByTenlqc(string $TenLQC) Return the first ChildLoaiquangcao filtered by the TenLQC column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoaiquangcao[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoaiquangcao objects based on current ModelCriteria
 * @method     ChildLoaiquangcao[]|ObjectCollection findByMalqc(int $MaLQC) Return ChildLoaiquangcao objects filtered by the MaLQC column
 * @method     ChildLoaiquangcao[]|ObjectCollection findByTenlqc(string $TenLQC) Return ChildLoaiquangcao objects filtered by the TenLQC column
 * @method     ChildLoaiquangcao[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoaiquangcaoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\LoaiquangcaoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Loaiquangcao', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoaiquangcaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoaiquangcaoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoaiquangcaoQuery) {
            return $criteria;
        }
        $query = new ChildLoaiquangcaoQuery();
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
     * @return ChildLoaiquangcao|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoaiquangcaoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LoaiquangcaoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLoaiquangcao A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaLQC, TenLQC FROM LoaiQuangCao WHERE MaLQC = :p0';
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
            /** @var ChildLoaiquangcao $obj */
            $obj = new ChildLoaiquangcao();
            $obj->hydrate($row);
            LoaiquangcaoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLoaiquangcao|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaLQC column
     *
     * Example usage:
     * <code>
     * $query->filterByMalqc(1234); // WHERE MaLQC = 1234
     * $query->filterByMalqc(array(12, 34)); // WHERE MaLQC IN (12, 34)
     * $query->filterByMalqc(array('min' => 12)); // WHERE MaLQC > 12
     * </code>
     *
     * @param     mixed $malqc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function filterByMalqc($malqc = null, $comparison = null)
    {
        if (is_array($malqc)) {
            $useMinMax = false;
            if (isset($malqc['min'])) {
                $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $malqc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($malqc['max'])) {
                $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $malqc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $malqc, $comparison);
    }

    /**
     * Filter the query on the TenLQC column
     *
     * Example usage:
     * <code>
     * $query->filterByTenlqc('fooValue');   // WHERE TenLQC = 'fooValue'
     * $query->filterByTenlqc('%fooValue%'); // WHERE TenLQC LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenlqc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function filterByTenlqc($tenlqc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenlqc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tenlqc)) {
                $tenlqc = str_replace('*', '%', $tenlqc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LoaiquangcaoTableMap::COL_TENLQC, $tenlqc, $comparison);
    }

    /**
     * Filter the query by a related \Model\Quangcao object
     *
     * @param \Model\Quangcao|ObjectCollection $quangcao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function filterByQuangcao($quangcao, $comparison = null)
    {
        if ($quangcao instanceof \Model\Quangcao) {
            return $this
                ->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $quangcao->getLoaiquangcaoMalqc(), $comparison);
        } elseif ($quangcao instanceof ObjectCollection) {
            return $this
                ->useQuangcaoQuery()
                ->filterByPrimaryKeys($quangcao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuangcao() only accepts arguments of type \Model\Quangcao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Quangcao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function joinQuangcao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Quangcao');

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
            $this->addJoinObject($join, 'Quangcao');
        }

        return $this;
    }

    /**
     * Use the Quangcao relation Quangcao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\QuangcaoQuery A secondary query class using the current class as primary query
     */
    public function useQuangcaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinQuangcao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Quangcao', '\Model\QuangcaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoaiquangcao $loaiquangcao Object to remove from the list of results
     *
     * @return $this|ChildLoaiquangcaoQuery The current query, for fluid interface
     */
    public function prune($loaiquangcao = null)
    {
        if ($loaiquangcao) {
            $this->addUsingAlias(LoaiquangcaoTableMap::COL_MALQC, $loaiquangcao->getMalqc(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the LoaiQuangCao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoaiquangcaoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoaiquangcaoTableMap::clearInstancePool();
            LoaiquangcaoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoaiquangcaoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoaiquangcaoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoaiquangcaoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoaiquangcaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LoaiquangcaoQuery
