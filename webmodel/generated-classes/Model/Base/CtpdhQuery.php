<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Ctpdh as ChildCtpdh;
use Model\CtpdhQuery as ChildCtpdhQuery;
use Model\Map\CtpdhTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'CTPDH' table.
 *
 *
 *
 * @method     ChildCtpdhQuery orderBySanphamMasanpham($order = Criteria::ASC) Order by the Sanpham_MaSanpham column
 * @method     ChildCtpdhQuery orderByPhieudathangSophieu($order = Criteria::ASC) Order by the PhieuDatHang_SoPhieu column
 * @method     ChildCtpdhQuery orderBySoluong($order = Criteria::ASC) Order by the SoLuong column
 *
 * @method     ChildCtpdhQuery groupBySanphamMasanpham() Group by the Sanpham_MaSanpham column
 * @method     ChildCtpdhQuery groupByPhieudathangSophieu() Group by the PhieuDatHang_SoPhieu column
 * @method     ChildCtpdhQuery groupBySoluong() Group by the SoLuong column
 *
 * @method     ChildCtpdhQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCtpdhQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCtpdhQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCtpdhQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCtpdhQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCtpdhQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCtpdhQuery leftJoinPhieudathang($relationAlias = null) Adds a LEFT JOIN clause to the query using the Phieudathang relation
 * @method     ChildCtpdhQuery rightJoinPhieudathang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Phieudathang relation
 * @method     ChildCtpdhQuery innerJoinPhieudathang($relationAlias = null) Adds a INNER JOIN clause to the query using the Phieudathang relation
 *
 * @method     ChildCtpdhQuery joinWithPhieudathang($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Phieudathang relation
 *
 * @method     ChildCtpdhQuery leftJoinWithPhieudathang() Adds a LEFT JOIN clause and with to the query using the Phieudathang relation
 * @method     ChildCtpdhQuery rightJoinWithPhieudathang() Adds a RIGHT JOIN clause and with to the query using the Phieudathang relation
 * @method     ChildCtpdhQuery innerJoinWithPhieudathang() Adds a INNER JOIN clause and with to the query using the Phieudathang relation
 *
 * @method     ChildCtpdhQuery leftJoinSanpham($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sanpham relation
 * @method     ChildCtpdhQuery rightJoinSanpham($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sanpham relation
 * @method     ChildCtpdhQuery innerJoinSanpham($relationAlias = null) Adds a INNER JOIN clause to the query using the Sanpham relation
 *
 * @method     ChildCtpdhQuery joinWithSanpham($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Sanpham relation
 *
 * @method     ChildCtpdhQuery leftJoinWithSanpham() Adds a LEFT JOIN clause and with to the query using the Sanpham relation
 * @method     ChildCtpdhQuery rightJoinWithSanpham() Adds a RIGHT JOIN clause and with to the query using the Sanpham relation
 * @method     ChildCtpdhQuery innerJoinWithSanpham() Adds a INNER JOIN clause and with to the query using the Sanpham relation
 *
 * @method     \Model\PhieudathangQuery|\Model\SanphamQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCtpdh findOne(ConnectionInterface $con = null) Return the first ChildCtpdh matching the query
 * @method     ChildCtpdh findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCtpdh matching the query, or a new ChildCtpdh object populated from the query conditions when no match is found
 *
 * @method     ChildCtpdh findOneBySanphamMasanpham(int $Sanpham_MaSanpham) Return the first ChildCtpdh filtered by the Sanpham_MaSanpham column
 * @method     ChildCtpdh findOneByPhieudathangSophieu(int $PhieuDatHang_SoPhieu) Return the first ChildCtpdh filtered by the PhieuDatHang_SoPhieu column
 * @method     ChildCtpdh findOneBySoluong(int $SoLuong) Return the first ChildCtpdh filtered by the SoLuong column *

 * @method     ChildCtpdh requirePk($key, ConnectionInterface $con = null) Return the ChildCtpdh by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCtpdh requireOne(ConnectionInterface $con = null) Return the first ChildCtpdh matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCtpdh requireOneBySanphamMasanpham(int $Sanpham_MaSanpham) Return the first ChildCtpdh filtered by the Sanpham_MaSanpham column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCtpdh requireOneByPhieudathangSophieu(int $PhieuDatHang_SoPhieu) Return the first ChildCtpdh filtered by the PhieuDatHang_SoPhieu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCtpdh requireOneBySoluong(int $SoLuong) Return the first ChildCtpdh filtered by the SoLuong column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCtpdh[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCtpdh objects based on current ModelCriteria
 * @method     ChildCtpdh[]|ObjectCollection findBySanphamMasanpham(int $Sanpham_MaSanpham) Return ChildCtpdh objects filtered by the Sanpham_MaSanpham column
 * @method     ChildCtpdh[]|ObjectCollection findByPhieudathangSophieu(int $PhieuDatHang_SoPhieu) Return ChildCtpdh objects filtered by the PhieuDatHang_SoPhieu column
 * @method     ChildCtpdh[]|ObjectCollection findBySoluong(int $SoLuong) Return ChildCtpdh objects filtered by the SoLuong column
 * @method     ChildCtpdh[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CtpdhQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\CtpdhQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Ctpdh', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCtpdhQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCtpdhQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCtpdhQuery) {
            return $criteria;
        }
        $query = new ChildCtpdhQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$Sanpham_MaSanpham, $PhieuDatHang_SoPhieu] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCtpdh|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CtpdhTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CtpdhTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildCtpdh A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Sanpham_MaSanpham, PhieuDatHang_SoPhieu, SoLuong FROM CTPDH WHERE Sanpham_MaSanpham = :p0 AND PhieuDatHang_SoPhieu = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCtpdh $obj */
            $obj = new ChildCtpdh();
            $obj->hydrate($row);
            CtpdhTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildCtpdh|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the Sanpham_MaSanpham column
     *
     * Example usage:
     * <code>
     * $query->filterBySanphamMasanpham(1234); // WHERE Sanpham_MaSanpham = 1234
     * $query->filterBySanphamMasanpham(array(12, 34)); // WHERE Sanpham_MaSanpham IN (12, 34)
     * $query->filterBySanphamMasanpham(array('min' => 12)); // WHERE Sanpham_MaSanpham > 12
     * </code>
     *
     * @see       filterBySanpham()
     *
     * @param     mixed $sanphamMasanpham The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterBySanphamMasanpham($sanphamMasanpham = null, $comparison = null)
    {
        if (is_array($sanphamMasanpham)) {
            $useMinMax = false;
            if (isset($sanphamMasanpham['min'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $sanphamMasanpham['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sanphamMasanpham['max'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $sanphamMasanpham['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $sanphamMasanpham, $comparison);
    }

    /**
     * Filter the query on the PhieuDatHang_SoPhieu column
     *
     * Example usage:
     * <code>
     * $query->filterByPhieudathangSophieu(1234); // WHERE PhieuDatHang_SoPhieu = 1234
     * $query->filterByPhieudathangSophieu(array(12, 34)); // WHERE PhieuDatHang_SoPhieu IN (12, 34)
     * $query->filterByPhieudathangSophieu(array('min' => 12)); // WHERE PhieuDatHang_SoPhieu > 12
     * </code>
     *
     * @see       filterByPhieudathang()
     *
     * @param     mixed $phieudathangSophieu The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterByPhieudathangSophieu($phieudathangSophieu = null, $comparison = null)
    {
        if (is_array($phieudathangSophieu)) {
            $useMinMax = false;
            if (isset($phieudathangSophieu['min'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $phieudathangSophieu['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($phieudathangSophieu['max'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $phieudathangSophieu['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $phieudathangSophieu, $comparison);
    }

    /**
     * Filter the query on the SoLuong column
     *
     * Example usage:
     * <code>
     * $query->filterBySoluong(1234); // WHERE SoLuong = 1234
     * $query->filterBySoluong(array(12, 34)); // WHERE SoLuong IN (12, 34)
     * $query->filterBySoluong(array('min' => 12)); // WHERE SoLuong > 12
     * </code>
     *
     * @param     mixed $soluong The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterBySoluong($soluong = null, $comparison = null)
    {
        if (is_array($soluong)) {
            $useMinMax = false;
            if (isset($soluong['min'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_SOLUONG, $soluong['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($soluong['max'])) {
                $this->addUsingAlias(CtpdhTableMap::COL_SOLUONG, $soluong['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CtpdhTableMap::COL_SOLUONG, $soluong, $comparison);
    }

    /**
     * Filter the query by a related \Model\Phieudathang object
     *
     * @param \Model\Phieudathang|ObjectCollection $phieudathang The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterByPhieudathang($phieudathang, $comparison = null)
    {
        if ($phieudathang instanceof \Model\Phieudathang) {
            return $this
                ->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $phieudathang->getSophieu(), $comparison);
        } elseif ($phieudathang instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU, $phieudathang->toKeyValue('PrimaryKey', 'Sophieu'), $comparison);
        } else {
            throw new PropelException('filterByPhieudathang() only accepts arguments of type \Model\Phieudathang or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Phieudathang relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function joinPhieudathang($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Phieudathang');

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
            $this->addJoinObject($join, 'Phieudathang');
        }

        return $this;
    }

    /**
     * Use the Phieudathang relation Phieudathang object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\PhieudathangQuery A secondary query class using the current class as primary query
     */
    public function usePhieudathangQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPhieudathang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Phieudathang', '\Model\PhieudathangQuery');
    }

    /**
     * Filter the query by a related \Model\Sanpham object
     *
     * @param \Model\Sanpham|ObjectCollection $sanpham The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCtpdhQuery The current query, for fluid interface
     */
    public function filterBySanpham($sanpham, $comparison = null)
    {
        if ($sanpham instanceof \Model\Sanpham) {
            return $this
                ->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $sanpham->getMasanpham(), $comparison);
        } elseif ($sanpham instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CtpdhTableMap::COL_SANPHAM_MASANPHAM, $sanpham->toKeyValue('PrimaryKey', 'Masanpham'), $comparison);
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
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
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
     * @param   ChildCtpdh $ctpdh Object to remove from the list of results
     *
     * @return $this|ChildCtpdhQuery The current query, for fluid interface
     */
    public function prune($ctpdh = null)
    {
        if ($ctpdh) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CtpdhTableMap::COL_SANPHAM_MASANPHAM), $ctpdh->getSanphamMasanpham(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CtpdhTableMap::COL_PHIEUDATHANG_SOPHIEU), $ctpdh->getPhieudathangSophieu(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the CTPDH table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CtpdhTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CtpdhTableMap::clearInstancePool();
            CtpdhTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CtpdhTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CtpdhTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CtpdhTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CtpdhTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CtpdhQuery
