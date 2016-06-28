<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Phieudathang as ChildPhieudathang;
use Model\PhieudathangQuery as ChildPhieudathangQuery;
use Model\Map\PhieudathangTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'PhieuDatHang' table.
 *
 *
 *
 * @method     ChildPhieudathangQuery orderBySophieu($order = Criteria::ASC) Order by the SoPhieu column
 * @method     ChildPhieudathangQuery orderByNgaylap($order = Criteria::ASC) Order by the NgayLap column
 * @method     ChildPhieudathangQuery orderByTennguoinhan($order = Criteria::ASC) Order by the TenNguoiNhan column
 * @method     ChildPhieudathangQuery orderByDiachi($order = Criteria::ASC) Order by the DiaChi column
 * @method     ChildPhieudathangQuery orderByThanhpho($order = Criteria::ASC) Order by the ThanhPho column
 * @method     ChildPhieudathangQuery orderByQuanHuyen($order = Criteria::ASC) Order by the Quan_Huyen column
 * @method     ChildPhieudathangQuery orderByPhuongXa($order = Criteria::ASC) Order by the Phuong_Xa column
 * @method     ChildPhieudathangQuery orderByChiphi($order = Criteria::ASC) Order by the ChiPhi column
 * @method     ChildPhieudathangQuery orderByKhachhangMakh($order = Criteria::ASC) Order by the KhachHang_MaKH column
 * @method     ChildPhieudathangQuery orderByTongtien($order = Criteria::ASC) Order by the TongTien column
 * @method     ChildPhieudathangQuery orderByNgaygiao($order = Criteria::ASC) Order by the NgayGiao column
 *
 * @method     ChildPhieudathangQuery groupBySophieu() Group by the SoPhieu column
 * @method     ChildPhieudathangQuery groupByNgaylap() Group by the NgayLap column
 * @method     ChildPhieudathangQuery groupByTennguoinhan() Group by the TenNguoiNhan column
 * @method     ChildPhieudathangQuery groupByDiachi() Group by the DiaChi column
 * @method     ChildPhieudathangQuery groupByThanhpho() Group by the ThanhPho column
 * @method     ChildPhieudathangQuery groupByQuanHuyen() Group by the Quan_Huyen column
 * @method     ChildPhieudathangQuery groupByPhuongXa() Group by the Phuong_Xa column
 * @method     ChildPhieudathangQuery groupByChiphi() Group by the ChiPhi column
 * @method     ChildPhieudathangQuery groupByKhachhangMakh() Group by the KhachHang_MaKH column
 * @method     ChildPhieudathangQuery groupByTongtien() Group by the TongTien column
 * @method     ChildPhieudathangQuery groupByNgaygiao() Group by the NgayGiao column
 *
 * @method     ChildPhieudathangQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPhieudathangQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPhieudathangQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPhieudathangQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPhieudathangQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPhieudathangQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPhieudathangQuery leftJoinKhachhang($relationAlias = null) Adds a LEFT JOIN clause to the query using the Khachhang relation
 * @method     ChildPhieudathangQuery rightJoinKhachhang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Khachhang relation
 * @method     ChildPhieudathangQuery innerJoinKhachhang($relationAlias = null) Adds a INNER JOIN clause to the query using the Khachhang relation
 *
 * @method     ChildPhieudathangQuery joinWithKhachhang($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Khachhang relation
 *
 * @method     ChildPhieudathangQuery leftJoinWithKhachhang() Adds a LEFT JOIN clause and with to the query using the Khachhang relation
 * @method     ChildPhieudathangQuery rightJoinWithKhachhang() Adds a RIGHT JOIN clause and with to the query using the Khachhang relation
 * @method     ChildPhieudathangQuery innerJoinWithKhachhang() Adds a INNER JOIN clause and with to the query using the Khachhang relation
 *
 * @method     ChildPhieudathangQuery leftJoinCtpdh($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ctpdh relation
 * @method     ChildPhieudathangQuery rightJoinCtpdh($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ctpdh relation
 * @method     ChildPhieudathangQuery innerJoinCtpdh($relationAlias = null) Adds a INNER JOIN clause to the query using the Ctpdh relation
 *
 * @method     ChildPhieudathangQuery joinWithCtpdh($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ctpdh relation
 *
 * @method     ChildPhieudathangQuery leftJoinWithCtpdh() Adds a LEFT JOIN clause and with to the query using the Ctpdh relation
 * @method     ChildPhieudathangQuery rightJoinWithCtpdh() Adds a RIGHT JOIN clause and with to the query using the Ctpdh relation
 * @method     ChildPhieudathangQuery innerJoinWithCtpdh() Adds a INNER JOIN clause and with to the query using the Ctpdh relation
 *
 * @method     \Model\KhachhangQuery|\Model\CtpdhQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPhieudathang findOne(ConnectionInterface $con = null) Return the first ChildPhieudathang matching the query
 * @method     ChildPhieudathang findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPhieudathang matching the query, or a new ChildPhieudathang object populated from the query conditions when no match is found
 *
 * @method     ChildPhieudathang findOneBySophieu(int $SoPhieu) Return the first ChildPhieudathang filtered by the SoPhieu column
 * @method     ChildPhieudathang findOneByNgaylap(string $NgayLap) Return the first ChildPhieudathang filtered by the NgayLap column
 * @method     ChildPhieudathang findOneByTennguoinhan(string $TenNguoiNhan) Return the first ChildPhieudathang filtered by the TenNguoiNhan column
 * @method     ChildPhieudathang findOneByDiachi(string $DiaChi) Return the first ChildPhieudathang filtered by the DiaChi column
 * @method     ChildPhieudathang findOneByThanhpho(string $ThanhPho) Return the first ChildPhieudathang filtered by the ThanhPho column
 * @method     ChildPhieudathang findOneByQuanHuyen(string $Quan_Huyen) Return the first ChildPhieudathang filtered by the Quan_Huyen column
 * @method     ChildPhieudathang findOneByPhuongXa(string $Phuong_Xa) Return the first ChildPhieudathang filtered by the Phuong_Xa column
 * @method     ChildPhieudathang findOneByChiphi(string $ChiPhi) Return the first ChildPhieudathang filtered by the ChiPhi column
 * @method     ChildPhieudathang findOneByKhachhangMakh(int $KhachHang_MaKH) Return the first ChildPhieudathang filtered by the KhachHang_MaKH column
 * @method     ChildPhieudathang findOneByTongtien(string $TongTien) Return the first ChildPhieudathang filtered by the TongTien column
 * @method     ChildPhieudathang findOneByNgaygiao(string $NgayGiao) Return the first ChildPhieudathang filtered by the NgayGiao column *

 * @method     ChildPhieudathang requirePk($key, ConnectionInterface $con = null) Return the ChildPhieudathang by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOne(ConnectionInterface $con = null) Return the first ChildPhieudathang matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhieudathang requireOneBySophieu(int $SoPhieu) Return the first ChildPhieudathang filtered by the SoPhieu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByNgaylap(string $NgayLap) Return the first ChildPhieudathang filtered by the NgayLap column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByTennguoinhan(string $TenNguoiNhan) Return the first ChildPhieudathang filtered by the TenNguoiNhan column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByDiachi(string $DiaChi) Return the first ChildPhieudathang filtered by the DiaChi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByThanhpho(string $ThanhPho) Return the first ChildPhieudathang filtered by the ThanhPho column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByQuanHuyen(string $Quan_Huyen) Return the first ChildPhieudathang filtered by the Quan_Huyen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByPhuongXa(string $Phuong_Xa) Return the first ChildPhieudathang filtered by the Phuong_Xa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByChiphi(string $ChiPhi) Return the first ChildPhieudathang filtered by the ChiPhi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByKhachhangMakh(int $KhachHang_MaKH) Return the first ChildPhieudathang filtered by the KhachHang_MaKH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByTongtien(string $TongTien) Return the first ChildPhieudathang filtered by the TongTien column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhieudathang requireOneByNgaygiao(string $NgayGiao) Return the first ChildPhieudathang filtered by the NgayGiao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhieudathang[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPhieudathang objects based on current ModelCriteria
 * @method     ChildPhieudathang[]|ObjectCollection findBySophieu(int $SoPhieu) Return ChildPhieudathang objects filtered by the SoPhieu column
 * @method     ChildPhieudathang[]|ObjectCollection findByNgaylap(string $NgayLap) Return ChildPhieudathang objects filtered by the NgayLap column
 * @method     ChildPhieudathang[]|ObjectCollection findByTennguoinhan(string $TenNguoiNhan) Return ChildPhieudathang objects filtered by the TenNguoiNhan column
 * @method     ChildPhieudathang[]|ObjectCollection findByDiachi(string $DiaChi) Return ChildPhieudathang objects filtered by the DiaChi column
 * @method     ChildPhieudathang[]|ObjectCollection findByThanhpho(string $ThanhPho) Return ChildPhieudathang objects filtered by the ThanhPho column
 * @method     ChildPhieudathang[]|ObjectCollection findByQuanHuyen(string $Quan_Huyen) Return ChildPhieudathang objects filtered by the Quan_Huyen column
 * @method     ChildPhieudathang[]|ObjectCollection findByPhuongXa(string $Phuong_Xa) Return ChildPhieudathang objects filtered by the Phuong_Xa column
 * @method     ChildPhieudathang[]|ObjectCollection findByChiphi(string $ChiPhi) Return ChildPhieudathang objects filtered by the ChiPhi column
 * @method     ChildPhieudathang[]|ObjectCollection findByKhachhangMakh(int $KhachHang_MaKH) Return ChildPhieudathang objects filtered by the KhachHang_MaKH column
 * @method     ChildPhieudathang[]|ObjectCollection findByTongtien(string $TongTien) Return ChildPhieudathang objects filtered by the TongTien column
 * @method     ChildPhieudathang[]|ObjectCollection findByNgaygiao(string $NgayGiao) Return ChildPhieudathang objects filtered by the NgayGiao column
 * @method     ChildPhieudathang[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PhieudathangQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\PhieudathangQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Phieudathang', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPhieudathangQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPhieudathangQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPhieudathangQuery) {
            return $criteria;
        }
        $query = new ChildPhieudathangQuery();
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
     * @return ChildPhieudathang|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PhieudathangTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPhieudathang A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT SoPhieu, NgayLap, TenNguoiNhan, DiaChi, ThanhPho, Quan_Huyen, Phuong_Xa, ChiPhi, KhachHang_MaKH, TongTien, NgayGiao FROM PhieuDatHang WHERE SoPhieu = :p0';
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
            /** @var ChildPhieudathang $obj */
            $obj = new ChildPhieudathang();
            $obj->hydrate($row);
            PhieudathangTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPhieudathang|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the SoPhieu column
     *
     * Example usage:
     * <code>
     * $query->filterBySophieu(1234); // WHERE SoPhieu = 1234
     * $query->filterBySophieu(array(12, 34)); // WHERE SoPhieu IN (12, 34)
     * $query->filterBySophieu(array('min' => 12)); // WHERE SoPhieu > 12
     * </code>
     *
     * @param     mixed $sophieu The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterBySophieu($sophieu = null, $comparison = null)
    {
        if (is_array($sophieu)) {
            $useMinMax = false;
            if (isset($sophieu['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $sophieu['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sophieu['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $sophieu['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $sophieu, $comparison);
    }

    /**
     * Filter the query on the NgayLap column
     *
     * Example usage:
     * <code>
     * $query->filterByNgaylap('2011-03-14'); // WHERE NgayLap = '2011-03-14'
     * $query->filterByNgaylap('now'); // WHERE NgayLap = '2011-03-14'
     * $query->filterByNgaylap(array('max' => 'yesterday')); // WHERE NgayLap > '2011-03-13'
     * </code>
     *
     * @param     mixed $ngaylap The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByNgaylap($ngaylap = null, $comparison = null)
    {
        if (is_array($ngaylap)) {
            $useMinMax = false;
            if (isset($ngaylap['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_NGAYLAP, $ngaylap['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ngaylap['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_NGAYLAP, $ngaylap['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_NGAYLAP, $ngaylap, $comparison);
    }

    /**
     * Filter the query on the TenNguoiNhan column
     *
     * Example usage:
     * <code>
     * $query->filterByTennguoinhan('fooValue');   // WHERE TenNguoiNhan = 'fooValue'
     * $query->filterByTennguoinhan('%fooValue%'); // WHERE TenNguoiNhan LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tennguoinhan The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByTennguoinhan($tennguoinhan = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tennguoinhan)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tennguoinhan)) {
                $tennguoinhan = str_replace('*', '%', $tennguoinhan);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_TENNGUOINHAN, $tennguoinhan, $comparison);
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
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByDiachi($diachi = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($diachi)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $diachi)) {
                $diachi = str_replace('*', '%', $diachi);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_DIACHI, $diachi, $comparison);
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
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByThanhpho($thanhpho = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thanhpho)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $thanhpho)) {
                $thanhpho = str_replace('*', '%', $thanhpho);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_THANHPHO, $thanhpho, $comparison);
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
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByQuanHuyen($quanHuyen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($quanHuyen)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $quanHuyen)) {
                $quanHuyen = str_replace('*', '%', $quanHuyen);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_QUAN_HUYEN, $quanHuyen, $comparison);
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
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByPhuongXa($phuongXa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phuongXa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phuongXa)) {
                $phuongXa = str_replace('*', '%', $phuongXa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_PHUONG_XA, $phuongXa, $comparison);
    }

    /**
     * Filter the query on the ChiPhi column
     *
     * Example usage:
     * <code>
     * $query->filterByChiphi(1234); // WHERE ChiPhi = 1234
     * $query->filterByChiphi(array(12, 34)); // WHERE ChiPhi IN (12, 34)
     * $query->filterByChiphi(array('min' => 12)); // WHERE ChiPhi > 12
     * </code>
     *
     * @param     mixed $chiphi The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByChiphi($chiphi = null, $comparison = null)
    {
        if (is_array($chiphi)) {
            $useMinMax = false;
            if (isset($chiphi['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_CHIPHI, $chiphi['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($chiphi['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_CHIPHI, $chiphi['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_CHIPHI, $chiphi, $comparison);
    }

    /**
     * Filter the query on the KhachHang_MaKH column
     *
     * Example usage:
     * <code>
     * $query->filterByKhachhangMakh(1234); // WHERE KhachHang_MaKH = 1234
     * $query->filterByKhachhangMakh(array(12, 34)); // WHERE KhachHang_MaKH IN (12, 34)
     * $query->filterByKhachhangMakh(array('min' => 12)); // WHERE KhachHang_MaKH > 12
     * </code>
     *
     * @see       filterByKhachhang()
     *
     * @param     mixed $khachhangMakh The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByKhachhangMakh($khachhangMakh = null, $comparison = null)
    {
        if (is_array($khachhangMakh)) {
            $useMinMax = false;
            if (isset($khachhangMakh['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_KHACHHANG_MAKH, $khachhangMakh['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($khachhangMakh['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_KHACHHANG_MAKH, $khachhangMakh['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_KHACHHANG_MAKH, $khachhangMakh, $comparison);
    }

    /**
     * Filter the query on the TongTien column
     *
     * Example usage:
     * <code>
     * $query->filterByTongtien(1234); // WHERE TongTien = 1234
     * $query->filterByTongtien(array(12, 34)); // WHERE TongTien IN (12, 34)
     * $query->filterByTongtien(array('min' => 12)); // WHERE TongTien > 12
     * </code>
     *
     * @param     mixed $tongtien The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByTongtien($tongtien = null, $comparison = null)
    {
        if (is_array($tongtien)) {
            $useMinMax = false;
            if (isset($tongtien['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_TONGTIEN, $tongtien['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tongtien['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_TONGTIEN, $tongtien['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_TONGTIEN, $tongtien, $comparison);
    }

    /**
     * Filter the query on the NgayGiao column
     *
     * Example usage:
     * <code>
     * $query->filterByNgaygiao('2011-03-14'); // WHERE NgayGiao = '2011-03-14'
     * $query->filterByNgaygiao('now'); // WHERE NgayGiao = '2011-03-14'
     * $query->filterByNgaygiao(array('max' => 'yesterday')); // WHERE NgayGiao > '2011-03-13'
     * </code>
     *
     * @param     mixed $ngaygiao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByNgaygiao($ngaygiao = null, $comparison = null)
    {
        if (is_array($ngaygiao)) {
            $useMinMax = false;
            if (isset($ngaygiao['min'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_NGAYGIAO, $ngaygiao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ngaygiao['max'])) {
                $this->addUsingAlias(PhieudathangTableMap::COL_NGAYGIAO, $ngaygiao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhieudathangTableMap::COL_NGAYGIAO, $ngaygiao, $comparison);
    }

    /**
     * Filter the query by a related \Model\Khachhang object
     *
     * @param \Model\Khachhang|ObjectCollection $khachhang The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByKhachhang($khachhang, $comparison = null)
    {
        if ($khachhang instanceof \Model\Khachhang) {
            return $this
                ->addUsingAlias(PhieudathangTableMap::COL_KHACHHANG_MAKH, $khachhang->getMakh(), $comparison);
        } elseif ($khachhang instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PhieudathangTableMap::COL_KHACHHANG_MAKH, $khachhang->toKeyValue('PrimaryKey', 'Makh'), $comparison);
        } else {
            throw new PropelException('filterByKhachhang() only accepts arguments of type \Model\Khachhang or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Khachhang relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function joinKhachhang($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Khachhang');

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
            $this->addJoinObject($join, 'Khachhang');
        }

        return $this;
    }

    /**
     * Use the Khachhang relation Khachhang object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\KhachhangQuery A secondary query class using the current class as primary query
     */
    public function useKhachhangQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinKhachhang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Khachhang', '\Model\KhachhangQuery');
    }

    /**
     * Filter the query by a related \Model\Ctpdh object
     *
     * @param \Model\Ctpdh|ObjectCollection $ctpdh the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterByCtpdh($ctpdh, $comparison = null)
    {
        if ($ctpdh instanceof \Model\Ctpdh) {
            return $this
                ->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $ctpdh->getPhieudathangSophieu(), $comparison);
        } elseif ($ctpdh instanceof ObjectCollection) {
            return $this
                ->useCtpdhQuery()
                ->filterByPrimaryKeys($ctpdh->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCtpdh() only accepts arguments of type \Model\Ctpdh or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ctpdh relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function joinCtpdh($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ctpdh');

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
            $this->addJoinObject($join, 'Ctpdh');
        }

        return $this;
    }

    /**
     * Use the Ctpdh relation Ctpdh object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\CtpdhQuery A secondary query class using the current class as primary query
     */
    public function useCtpdhQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCtpdh($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ctpdh', '\Model\CtpdhQuery');
    }

    /**
     * Filter the query by a related Sanpham object
     * using the CTPDH table as cross reference
     *
     * @param Sanpham $sanpham the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPhieudathangQuery The current query, for fluid interface
     */
    public function filterBySanpham($sanpham, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCtpdhQuery()
            ->filterBySanpham($sanpham, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPhieudathang $phieudathang Object to remove from the list of results
     *
     * @return $this|ChildPhieudathangQuery The current query, for fluid interface
     */
    public function prune($phieudathang = null)
    {
        if ($phieudathang) {
            $this->addUsingAlias(PhieudathangTableMap::COL_SOPHIEU, $phieudathang->getSophieu(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the PhieuDatHang table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PhieudathangTableMap::clearInstancePool();
            PhieudathangTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PhieudathangTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PhieudathangTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PhieudathangTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PhieudathangTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PhieudathangQuery
