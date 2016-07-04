<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Khachhang as ChildKhachhang;
use Model\KhachhangQuery as ChildKhachhangQuery;
use Model\Map\KhachhangTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'KhachHang' table.
 *
 *
 *
 * @method     ChildKhachhangQuery orderByMakh($order = Criteria::ASC) Order by the MaKH column
 * @method     ChildKhachhangQuery orderByTenkh($order = Criteria::ASC) Order by the TenKH column
 * @method     ChildKhachhangQuery orderByDt($order = Criteria::ASC) Order by the DT column
 * @method     ChildKhachhangQuery orderByEmail($order = Criteria::ASC) Order by the Email column
 * @method     ChildKhachhangQuery orderByDiachi($order = Criteria::ASC) Order by the DiaChi column
 * @method     ChildKhachhangQuery orderByThanhpho($order = Criteria::ASC) Order by the ThanhPho column
 * @method     ChildKhachhangQuery orderByQuanHuyen($order = Criteria::ASC) Order by the Quan_Huyen column
 * @method     ChildKhachhangQuery orderByPhuongXa($order = Criteria::ASC) Order by the Phuong_Xa column
 * @method     ChildKhachhangQuery orderByUsername($order = Criteria::ASC) Order by the UserName column
 * @method     ChildKhachhangQuery orderByPassword($order = Criteria::ASC) Order by the Password column
 *
 * @method     ChildKhachhangQuery groupByMakh() Group by the MaKH column
 * @method     ChildKhachhangQuery groupByTenkh() Group by the TenKH column
 * @method     ChildKhachhangQuery groupByDt() Group by the DT column
 * @method     ChildKhachhangQuery groupByEmail() Group by the Email column
 * @method     ChildKhachhangQuery groupByDiachi() Group by the DiaChi column
 * @method     ChildKhachhangQuery groupByThanhpho() Group by the ThanhPho column
 * @method     ChildKhachhangQuery groupByQuanHuyen() Group by the Quan_Huyen column
 * @method     ChildKhachhangQuery groupByPhuongXa() Group by the Phuong_Xa column
 * @method     ChildKhachhangQuery groupByUsername() Group by the UserName column
 * @method     ChildKhachhangQuery groupByPassword() Group by the Password column
 *
 * @method     ChildKhachhangQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildKhachhangQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildKhachhangQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildKhachhangQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildKhachhangQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildKhachhangQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildKhachhangQuery leftJoinPhieudathang($relationAlias = null) Adds a LEFT JOIN clause to the query using the Phieudathang relation
 * @method     ChildKhachhangQuery rightJoinPhieudathang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Phieudathang relation
 * @method     ChildKhachhangQuery innerJoinPhieudathang($relationAlias = null) Adds a INNER JOIN clause to the query using the Phieudathang relation
 *
 * @method     ChildKhachhangQuery joinWithPhieudathang($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Phieudathang relation
 *
 * @method     ChildKhachhangQuery leftJoinWithPhieudathang() Adds a LEFT JOIN clause and with to the query using the Phieudathang relation
 * @method     ChildKhachhangQuery rightJoinWithPhieudathang() Adds a RIGHT JOIN clause and with to the query using the Phieudathang relation
 * @method     ChildKhachhangQuery innerJoinWithPhieudathang() Adds a INNER JOIN clause and with to the query using the Phieudathang relation
 *
 * @method     \Model\PhieudathangQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildKhachhang findOne(ConnectionInterface $con = null) Return the first ChildKhachhang matching the query
 * @method     ChildKhachhang findOneOrCreate(ConnectionInterface $con = null) Return the first ChildKhachhang matching the query, or a new ChildKhachhang object populated from the query conditions when no match is found
 *
 * @method     ChildKhachhang findOneByMakh(int $MaKH) Return the first ChildKhachhang filtered by the MaKH column
 * @method     ChildKhachhang findOneByTenkh(string $TenKH) Return the first ChildKhachhang filtered by the TenKH column
 * @method     ChildKhachhang findOneByDt(string $DT) Return the first ChildKhachhang filtered by the DT column
 * @method     ChildKhachhang findOneByEmail(string $Email) Return the first ChildKhachhang filtered by the Email column
 * @method     ChildKhachhang findOneByDiachi(string $DiaChi) Return the first ChildKhachhang filtered by the DiaChi column
 * @method     ChildKhachhang findOneByThanhpho(string $ThanhPho) Return the first ChildKhachhang filtered by the ThanhPho column
 * @method     ChildKhachhang findOneByQuanHuyen(string $Quan_Huyen) Return the first ChildKhachhang filtered by the Quan_Huyen column
 * @method     ChildKhachhang findOneByPhuongXa(string $Phuong_Xa) Return the first ChildKhachhang filtered by the Phuong_Xa column
 * @method     ChildKhachhang findOneByUsername(string $UserName) Return the first ChildKhachhang filtered by the UserName column
 * @method     ChildKhachhang findOneByPassword(string $Password) Return the first ChildKhachhang filtered by the Password column *

 * @method     ChildKhachhang requirePk($key, ConnectionInterface $con = null) Return the ChildKhachhang by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOne(ConnectionInterface $con = null) Return the first ChildKhachhang matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKhachhang requireOneByMakh(int $MaKH) Return the first ChildKhachhang filtered by the MaKH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByTenkh(string $TenKH) Return the first ChildKhachhang filtered by the TenKH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByDt(string $DT) Return the first ChildKhachhang filtered by the DT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByEmail(string $Email) Return the first ChildKhachhang filtered by the Email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByDiachi(string $DiaChi) Return the first ChildKhachhang filtered by the DiaChi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByThanhpho(string $ThanhPho) Return the first ChildKhachhang filtered by the ThanhPho column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByQuanHuyen(string $Quan_Huyen) Return the first ChildKhachhang filtered by the Quan_Huyen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByPhuongXa(string $Phuong_Xa) Return the first ChildKhachhang filtered by the Phuong_Xa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByUsername(string $UserName) Return the first ChildKhachhang filtered by the UserName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKhachhang requireOneByPassword(string $Password) Return the first ChildKhachhang filtered by the Password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKhachhang[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildKhachhang objects based on current ModelCriteria
 * @method     ChildKhachhang[]|ObjectCollection findByMakh(int $MaKH) Return ChildKhachhang objects filtered by the MaKH column
 * @method     ChildKhachhang[]|ObjectCollection findByTenkh(string $TenKH) Return ChildKhachhang objects filtered by the TenKH column
 * @method     ChildKhachhang[]|ObjectCollection findByDt(string $DT) Return ChildKhachhang objects filtered by the DT column
 * @method     ChildKhachhang[]|ObjectCollection findByEmail(string $Email) Return ChildKhachhang objects filtered by the Email column
 * @method     ChildKhachhang[]|ObjectCollection findByDiachi(string $DiaChi) Return ChildKhachhang objects filtered by the DiaChi column
 * @method     ChildKhachhang[]|ObjectCollection findByThanhpho(string $ThanhPho) Return ChildKhachhang objects filtered by the ThanhPho column
 * @method     ChildKhachhang[]|ObjectCollection findByQuanHuyen(string $Quan_Huyen) Return ChildKhachhang objects filtered by the Quan_Huyen column
 * @method     ChildKhachhang[]|ObjectCollection findByPhuongXa(string $Phuong_Xa) Return ChildKhachhang objects filtered by the Phuong_Xa column
 * @method     ChildKhachhang[]|ObjectCollection findByUsername(string $UserName) Return ChildKhachhang objects filtered by the UserName column
 * @method     ChildKhachhang[]|ObjectCollection findByPassword(string $Password) Return ChildKhachhang objects filtered by the Password column
 * @method     ChildKhachhang[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class KhachhangQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\KhachhangQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Khachhang', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildKhachhangQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildKhachhangQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildKhachhangQuery) {
            return $criteria;
        }
        $query = new ChildKhachhangQuery();
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
     * @return ChildKhachhang|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(KhachhangTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = KhachhangTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildKhachhang A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaKH, TenKH, DT, Email, DiaChi, ThanhPho, Quan_Huyen, Phuong_Xa, UserName, Password FROM KhachHang WHERE MaKH = :p0';
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
            /** @var ChildKhachhang $obj */
            $obj = new ChildKhachhang();
            $obj->hydrate($row);
            KhachhangTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildKhachhang|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaKH column
     *
     * Example usage:
     * <code>
     * $query->filterByMakh(1234); // WHERE MaKH = 1234
     * $query->filterByMakh(array(12, 34)); // WHERE MaKH IN (12, 34)
     * $query->filterByMakh(array('min' => 12)); // WHERE MaKH > 12
     * </code>
     *
     * @param     mixed $makh The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByMakh($makh = null, $comparison = null)
    {
        if (is_array($makh)) {
            $useMinMax = false;
            if (isset($makh['min'])) {
                $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $makh['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($makh['max'])) {
                $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $makh['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $makh, $comparison);
    }

    /**
     * Filter the query on the TenKH column
     *
     * Example usage:
     * <code>
     * $query->filterByTenkh('fooValue');   // WHERE TenKH = 'fooValue'
     * $query->filterByTenkh('%fooValue%'); // WHERE TenKH LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tenkh The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByTenkh($tenkh = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tenkh)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_TENKH, $tenkh, $comparison);
    }

    /**
     * Filter the query on the DT column
     *
     * Example usage:
     * <code>
     * $query->filterByDt('fooValue');   // WHERE DT = 'fooValue'
     * $query->filterByDt('%fooValue%'); // WHERE DT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByDt($dt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dt)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_DT, $dt, $comparison);
    }

    /**
     * Filter the query on the Email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE Email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE Email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the DiaChi column
     *
     * Example usage:
     * <code>
     * $query->filterByDiachi('fooValue');   // WHERE DiaChi = 'fooValue'
     * $query->filterByDiachi('%fooValue%'); // WHERE DiaChi LIKE '%fooValue%'
     * </code>
     *
     * @param     string $diachi The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByDiachi($diachi = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($diachi)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_DIACHI, $diachi, $comparison);
    }

    /**
     * Filter the query on the ThanhPho column
     *
     * Example usage:
     * <code>
     * $query->filterByThanhpho('fooValue');   // WHERE ThanhPho = 'fooValue'
     * $query->filterByThanhpho('%fooValue%'); // WHERE ThanhPho LIKE '%fooValue%'
     * </code>
     *
     * @param     string $thanhpho The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByThanhpho($thanhpho = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thanhpho)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_THANHPHO, $thanhpho, $comparison);
    }

    /**
     * Filter the query on the Quan_Huyen column
     *
     * Example usage:
     * <code>
     * $query->filterByQuanHuyen('fooValue');   // WHERE Quan_Huyen = 'fooValue'
     * $query->filterByQuanHuyen('%fooValue%'); // WHERE Quan_Huyen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $quanHuyen The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByQuanHuyen($quanHuyen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($quanHuyen)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_QUAN_HUYEN, $quanHuyen, $comparison);
    }

    /**
     * Filter the query on the Phuong_Xa column
     *
     * Example usage:
     * <code>
     * $query->filterByPhuongXa('fooValue');   // WHERE Phuong_Xa = 'fooValue'
     * $query->filterByPhuongXa('%fooValue%'); // WHERE Phuong_Xa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phuongXa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByPhuongXa($phuongXa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phuongXa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_PHUONG_XA, $phuongXa, $comparison);
    }

    /**
     * Filter the query on the UserName column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE UserName = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE UserName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the Password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE Password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE Password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KhachhangTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query by a related \Model\Phieudathang object
     *
     * @param \Model\Phieudathang|ObjectCollection $phieudathang the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildKhachhangQuery The current query, for fluid interface
     */
    public function filterByPhieudathang($phieudathang, $comparison = null)
    {
        if ($phieudathang instanceof \Model\Phieudathang) {
            return $this
                ->addUsingAlias(KhachhangTableMap::COL_MAKH, $phieudathang->getKhachhangMakh(), $comparison);
        } elseif ($phieudathang instanceof ObjectCollection) {
            return $this
                ->usePhieudathangQuery()
                ->filterByPrimaryKeys($phieudathang->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function joinPhieudathang($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePhieudathangQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPhieudathang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Phieudathang', '\Model\PhieudathangQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildKhachhang $khachhang Object to remove from the list of results
     *
     * @return $this|ChildKhachhangQuery The current query, for fluid interface
     */
    public function prune($khachhang = null)
    {
        if ($khachhang) {
            $this->addUsingAlias(KhachhangTableMap::COL_MAKH, $khachhang->getMakh(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the KhachHang table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            KhachhangTableMap::clearInstancePool();
            KhachhangTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(KhachhangTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(KhachhangTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            KhachhangTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            KhachhangTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // KhachhangQuery
