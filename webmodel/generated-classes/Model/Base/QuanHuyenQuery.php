<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\QuanHuyen as ChildQuanHuyen;
use Model\QuanHuyenQuery as ChildQuanHuyenQuery;
use Model\Map\QuanHuyenTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Quan_Huyen' table.
 *
 *
 *
 * @method     ChildQuanHuyenQuery orderByMaquanHuyen($order = Criteria::ASC) Order by the MaQuan_Huyen column
 * @method     ChildQuanHuyenQuery orderByTenquanHuyen($order = Criteria::ASC) Order by the TenQuan_Huyen column
 * @method     ChildQuanHuyenQuery orderByChiphigiaohang($order = Criteria::ASC) Order by the ChiPhiGiaoHang column
 * @method     ChildQuanHuyenQuery orderByThanhphoMatp($order = Criteria::ASC) Order by the ThanhPho_MaTP column
 *
 * @method     ChildQuanHuyenQuery groupByMaquanHuyen() Group by the MaQuan_Huyen column
 * @method     ChildQuanHuyenQuery groupByTenquanHuyen() Group by the TenQuan_Huyen column
 * @method     ChildQuanHuyenQuery groupByChiphigiaohang() Group by the ChiPhiGiaoHang column
 * @method     ChildQuanHuyenQuery groupByThanhphoMatp() Group by the ThanhPho_MaTP column
 *
 * @method     ChildQuanHuyenQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuanHuyenQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuanHuyenQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuanHuyenQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuanHuyenQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuanHuyenQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuanHuyenQuery leftJoinThanhpho($relationAlias = null) Adds a LEFT JOIN clause to the query using the Thanhpho relation
 * @method     ChildQuanHuyenQuery rightJoinThanhpho($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Thanhpho relation
 * @method     ChildQuanHuyenQuery innerJoinThanhpho($relationAlias = null) Adds a INNER JOIN clause to the query using the Thanhpho relation
 *
 * @method     ChildQuanHuyenQuery joinWithThanhpho($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Thanhpho relation
 *
 * @method     ChildQuanHuyenQuery leftJoinWithThanhpho() Adds a LEFT JOIN clause and with to the query using the Thanhpho relation
 * @method     ChildQuanHuyenQuery rightJoinWithThanhpho() Adds a RIGHT JOIN clause and with to the query using the Thanhpho relation
 * @method     ChildQuanHuyenQuery innerJoinWithThanhpho() Adds a INNER JOIN clause and with to the query using the Thanhpho relation
 *
 * @method     ChildQuanHuyenQuery leftJoinPhuongXa($relationAlias = null) Adds a LEFT JOIN clause to the query using the PhuongXa relation
 * @method     ChildQuanHuyenQuery rightJoinPhuongXa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PhuongXa relation
 * @method     ChildQuanHuyenQuery innerJoinPhuongXa($relationAlias = null) Adds a INNER JOIN clause to the query using the PhuongXa relation
 *
 * @method     ChildQuanHuyenQuery joinWithPhuongXa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PhuongXa relation
 *
 * @method     ChildQuanHuyenQuery leftJoinWithPhuongXa() Adds a LEFT JOIN clause and with to the query using the PhuongXa relation
 * @method     ChildQuanHuyenQuery rightJoinWithPhuongXa() Adds a RIGHT JOIN clause and with to the query using the PhuongXa relation
 * @method     ChildQuanHuyenQuery innerJoinWithPhuongXa() Adds a INNER JOIN clause and with to the query using the PhuongXa relation
 *
 * @method     \Model\ThanhphoQuery|\Model\PhuongXaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuanHuyen findOne(ConnectionInterface $con = null) Return the first ChildQuanHuyen matching the query
 * @method     ChildQuanHuyen findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuanHuyen matching the query, or a new ChildQuanHuyen object populated from the query conditions when no match is found
 *
 * @method     ChildQuanHuyen findOneByMaquanHuyen(int $MaQuan_Huyen) Return the first ChildQuanHuyen filtered by the MaQuan_Huyen column
 * @method     ChildQuanHuyen findOneByTenquanHuyen(string $TenQuan_Huyen) Return the first ChildQuanHuyen filtered by the TenQuan_Huyen column
 * @method     ChildQuanHuyen findOneByChiphigiaohang(string $ChiPhiGiaoHang) Return the first ChildQuanHuyen filtered by the ChiPhiGiaoHang column
 * @method     ChildQuanHuyen findOneByThanhphoMatp(int $ThanhPho_MaTP) Return the first ChildQuanHuyen filtered by the ThanhPho_MaTP column *

 * @method     ChildQuanHuyen requirePk($key, ConnectionInterface $con = null) Return the ChildQuanHuyen by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuanHuyen requireOne(ConnectionInterface $con = null) Return the first ChildQuanHuyen matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuanHuyen requireOneByMaquanHuyen(int $MaQuan_Huyen) Return the first ChildQuanHuyen filtered by the MaQuan_Huyen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuanHuyen requireOneByTenquanHuyen(string $TenQuan_Huyen) Return the first ChildQuanHuyen filtered by the TenQuan_Huyen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuanHuyen requireOneByChiphigiaohang(string $ChiPhiGiaoHang) Return the first ChildQuanHuyen filtered by the ChiPhiGiaoHang column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuanHuyen requireOneByThanhphoMatp(int $ThanhPho_MaTP) Return the first ChildQuanHuyen filtered by the ThanhPho_MaTP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuanHuyen[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuanHuyen objects based on current ModelCriteria
 * @method     ChildQuanHuyen[]|ObjectCollection findByMaquanHuyen(int $MaQuan_Huyen) Return ChildQuanHuyen objects filtered by the MaQuan_Huyen column
 * @method     ChildQuanHuyen[]|ObjectCollection findByTenquanHuyen(string $TenQuan_Huyen) Return ChildQuanHuyen objects filtered by the TenQuan_Huyen column
 * @method     ChildQuanHuyen[]|ObjectCollection findByChiphigiaohang(string $ChiPhiGiaoHang) Return ChildQuanHuyen objects filtered by the ChiPhiGiaoHang column
 * @method     ChildQuanHuyen[]|ObjectCollection findByThanhphoMatp(int $ThanhPho_MaTP) Return ChildQuanHuyen objects filtered by the ThanhPho_MaTP column
 * @method     ChildQuanHuyen[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuanHuyenQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\QuanHuyenQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\QuanHuyen', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuanHuyenQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuanHuyenQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuanHuyenQuery) {
            return $criteria;
        }
        $query = new ChildQuanHuyenQuery();
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
     * @return ChildQuanHuyen|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuanHuyenTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuanHuyenTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuanHuyen A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaQuan_Huyen, TenQuan_Huyen, ChiPhiGiaoHang, ThanhPho_MaTP FROM Quan_Huyen WHERE MaQuan_Huyen = :p0';
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
            /** @var ChildQuanHuyen $obj */
            $obj = new ChildQuanHuyen();
            $obj->hydrate($row);
            QuanHuyenTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuanHuyen|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaQuan_Huyen column
     *
     * Example usage:
     * <code>
     * $query->filterByMaquanHuyen(1234); // WHERE MaQuan_Huyen = 1234
     * $query->filterByMaquanHuyen(array(12, 34)); // WHERE MaQuan_Huyen IN (12, 34)
     * $query->filterByMaquanHuyen(array('min' => 12)); // WHERE MaQuan_Huyen > 12
     * </code>
     *
     * @param     mixed $maquanHuyen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByMaquanHuyen($maquanHuyen = null, $comparison = null)
    {
        if (is_array($maquanHuyen)) {
            $useMinMax = false;
            if (isset($maquanHuyen['min'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $maquanHuyen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maquanHuyen['max'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $maquanHuyen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $maquanHuyen, $comparison);
    }

    /**
     * Filter the query on the TenQuan_Huyen column
     *
     * Example usage:
     * <code>
     * $query->filterByTenquanHuyen('fooValue');   // WHERE TenQuan_Huyen = 'fooValue'
     * $query->filterByTenquanHuyen('%fooValue%'); // WHERE TenQuan_Huyen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenquanHuyen The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByTenquanHuyen($tenquanHuyen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenquanHuyen)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tenquanHuyen)) {
                $tenquanHuyen = str_replace('*', '%', $tenquanHuyen);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(QuanHuyenTableMap::COL_TENQUAN_HUYEN, $tenquanHuyen, $comparison);
    }

    /**
     * Filter the query on the ChiPhiGiaoHang column
     *
     * Example usage:
     * <code>
     * $query->filterByChiphigiaohang(1234); // WHERE ChiPhiGiaoHang = 1234
     * $query->filterByChiphigiaohang(array(12, 34)); // WHERE ChiPhiGiaoHang IN (12, 34)
     * $query->filterByChiphigiaohang(array('min' => 12)); // WHERE ChiPhiGiaoHang > 12
     * </code>
     *
     * @param     mixed $chiphigiaohang The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByChiphigiaohang($chiphigiaohang = null, $comparison = null)
    {
        if (is_array($chiphigiaohang)) {
            $useMinMax = false;
            if (isset($chiphigiaohang['min'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_CHIPHIGIAOHANG, $chiphigiaohang['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($chiphigiaohang['max'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_CHIPHIGIAOHANG, $chiphigiaohang['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuanHuyenTableMap::COL_CHIPHIGIAOHANG, $chiphigiaohang, $comparison);
    }

    /**
     * Filter the query on the ThanhPho_MaTP column
     *
     * Example usage:
     * <code>
     * $query->filterByThanhphoMatp(1234); // WHERE ThanhPho_MaTP = 1234
     * $query->filterByThanhphoMatp(array(12, 34)); // WHERE ThanhPho_MaTP IN (12, 34)
     * $query->filterByThanhphoMatp(array('min' => 12)); // WHERE ThanhPho_MaTP > 12
     * </code>
     *
     * @see       filterByThanhpho()
     *
     * @param     mixed $thanhphoMatp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByThanhphoMatp($thanhphoMatp = null, $comparison = null)
    {
        if (is_array($thanhphoMatp)) {
            $useMinMax = false;
            if (isset($thanhphoMatp['min'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_THANHPHO_MATP, $thanhphoMatp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($thanhphoMatp['max'])) {
                $this->addUsingAlias(QuanHuyenTableMap::COL_THANHPHO_MATP, $thanhphoMatp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuanHuyenTableMap::COL_THANHPHO_MATP, $thanhphoMatp, $comparison);
    }

    /**
     * Filter the query by a related \Model\Thanhpho object
     *
     * @param \Model\Thanhpho|ObjectCollection $thanhpho The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByThanhpho($thanhpho, $comparison = null)
    {
        if ($thanhpho instanceof \Model\Thanhpho) {
            return $this
                ->addUsingAlias(QuanHuyenTableMap::COL_THANHPHO_MATP, $thanhpho->getMatp(), $comparison);
        } elseif ($thanhpho instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuanHuyenTableMap::COL_THANHPHO_MATP, $thanhpho->toKeyValue('PrimaryKey', 'Matp'), $comparison);
        } else {
            throw new PropelException('filterByThanhpho() only accepts arguments of type \Model\Thanhpho or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Thanhpho relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function joinThanhpho($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Thanhpho');

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
            $this->addJoinObject($join, 'Thanhpho');
        }

        return $this;
    }

    /**
     * Use the Thanhpho relation Thanhpho object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ThanhphoQuery A secondary query class using the current class as primary query
     */
    public function useThanhphoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinThanhpho($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Thanhpho', '\Model\ThanhphoQuery');
    }

    /**
     * Filter the query by a related \Model\PhuongXa object
     *
     * @param \Model\PhuongXa|ObjectCollection $phuongXa the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function filterByPhuongXa($phuongXa, $comparison = null)
    {
        if ($phuongXa instanceof \Model\PhuongXa) {
            return $this
                ->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $phuongXa->getQuanHuyenMaquanHuyen(), $comparison);
        } elseif ($phuongXa instanceof ObjectCollection) {
            return $this
                ->usePhuongXaQuery()
                ->filterByPrimaryKeys($phuongXa->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPhuongXa() only accepts arguments of type \Model\PhuongXa or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PhuongXa relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function joinPhuongXa($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PhuongXa');

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
            $this->addJoinObject($join, 'PhuongXa');
        }

        return $this;
    }

    /**
     * Use the PhuongXa relation PhuongXa object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\PhuongXaQuery A secondary query class using the current class as primary query
     */
    public function usePhuongXaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPhuongXa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PhuongXa', '\Model\PhuongXaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildQuanHuyen $quanHuyen Object to remove from the list of results
     *
     * @return $this|ChildQuanHuyenQuery The current query, for fluid interface
     */
    public function prune($quanHuyen = null)
    {
        if ($quanHuyen) {
            $this->addUsingAlias(QuanHuyenTableMap::COL_MAQUAN_HUYEN, $quanHuyen->getMaquanHuyen(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Quan_Huyen table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuanHuyenTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuanHuyenTableMap::clearInstancePool();
            QuanHuyenTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuanHuyenTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuanHuyenTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            QuanHuyenTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            QuanHuyenTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuanHuyenQuery
