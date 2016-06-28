<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Sanpham as ChildSanpham;
use Model\SanphamQuery as ChildSanphamQuery;
use Model\Map\SanphamTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Sanpham' table.
 *
 *
 *
 * @method     ChildSanphamQuery orderByMasanpham($order = Criteria::ASC) Order by the MaSanpham column
 * @method     ChildSanphamQuery orderByTensanpham($order = Criteria::ASC) Order by the TenSanpham column
 * @method     ChildSanphamQuery orderByHinhanh($order = Criteria::ASC) Order by the HInhAnh column
 * @method     ChildSanphamQuery orderByGiasp($order = Criteria::ASC) Order by the GiaSP column
 * @method     ChildSanphamQuery orderByDonvitinh($order = Criteria::ASC) Order by the DonViTinh column
 * @method     ChildSanphamQuery orderByThongtin($order = Criteria::ASC) Order by the ThongTin column
 * @method     ChildSanphamQuery orderByLoaispMaloaisp($order = Criteria::ASC) Order by the LoaiSP_MaLoaiSP column
 * @method     ChildSanphamQuery orderByGianhap($order = Criteria::ASC) Order by the GiaNhap column
 * @method     ChildSanphamQuery orderByLuotxem($order = Criteria::ASC) Order by the LuotXem column
 *
 * @method     ChildSanphamQuery groupByMasanpham() Group by the MaSanpham column
 * @method     ChildSanphamQuery groupByTensanpham() Group by the TenSanpham column
 * @method     ChildSanphamQuery groupByHinhanh() Group by the HInhAnh column
 * @method     ChildSanphamQuery groupByGiasp() Group by the GiaSP column
 * @method     ChildSanphamQuery groupByDonvitinh() Group by the DonViTinh column
 * @method     ChildSanphamQuery groupByThongtin() Group by the ThongTin column
 * @method     ChildSanphamQuery groupByLoaispMaloaisp() Group by the LoaiSP_MaLoaiSP column
 * @method     ChildSanphamQuery groupByGianhap() Group by the GiaNhap column
 * @method     ChildSanphamQuery groupByLuotxem() Group by the LuotXem column
 *
 * @method     ChildSanphamQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSanphamQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSanphamQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSanphamQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSanphamQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSanphamQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSanphamQuery leftJoinLoaisp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Loaisp relation
 * @method     ChildSanphamQuery rightJoinLoaisp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Loaisp relation
 * @method     ChildSanphamQuery innerJoinLoaisp($relationAlias = null) Adds a INNER JOIN clause to the query using the Loaisp relation
 *
 * @method     ChildSanphamQuery joinWithLoaisp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Loaisp relation
 *
 * @method     ChildSanphamQuery leftJoinWithLoaisp() Adds a LEFT JOIN clause and with to the query using the Loaisp relation
 * @method     ChildSanphamQuery rightJoinWithLoaisp() Adds a RIGHT JOIN clause and with to the query using the Loaisp relation
 * @method     ChildSanphamQuery innerJoinWithLoaisp() Adds a INNER JOIN clause and with to the query using the Loaisp relation
 *
 * @method     ChildSanphamQuery leftJoinCtpdh($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ctpdh relation
 * @method     ChildSanphamQuery rightJoinCtpdh($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ctpdh relation
 * @method     ChildSanphamQuery innerJoinCtpdh($relationAlias = null) Adds a INNER JOIN clause to the query using the Ctpdh relation
 *
 * @method     ChildSanphamQuery joinWithCtpdh($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ctpdh relation
 *
 * @method     ChildSanphamQuery leftJoinWithCtpdh() Adds a LEFT JOIN clause and with to the query using the Ctpdh relation
 * @method     ChildSanphamQuery rightJoinWithCtpdh() Adds a RIGHT JOIN clause and with to the query using the Ctpdh relation
 * @method     ChildSanphamQuery innerJoinWithCtpdh() Adds a INNER JOIN clause and with to the query using the Ctpdh relation
 *
 * @method     \Model\LoaispQuery|\Model\CtpdhQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSanpham findOne(ConnectionInterface $con = null) Return the first ChildSanpham matching the query
 * @method     ChildSanpham findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSanpham matching the query, or a new ChildSanpham object populated from the query conditions when no match is found
 *
 * @method     ChildSanpham findOneByMasanpham(int $MaSanpham) Return the first ChildSanpham filtered by the MaSanpham column
 * @method     ChildSanpham findOneByTensanpham(string $TenSanpham) Return the first ChildSanpham filtered by the TenSanpham column
 * @method     ChildSanpham findOneByHinhanh(string $HInhAnh) Return the first ChildSanpham filtered by the HInhAnh column
 * @method     ChildSanpham findOneByGiasp(string $GiaSP) Return the first ChildSanpham filtered by the GiaSP column
 * @method     ChildSanpham findOneByDonvitinh(string $DonViTinh) Return the first ChildSanpham filtered by the DonViTinh column
 * @method     ChildSanpham findOneByThongtin(string $ThongTin) Return the first ChildSanpham filtered by the ThongTin column
 * @method     ChildSanpham findOneByLoaispMaloaisp(int $LoaiSP_MaLoaiSP) Return the first ChildSanpham filtered by the LoaiSP_MaLoaiSP column
 * @method     ChildSanpham findOneByGianhap(string $GiaNhap) Return the first ChildSanpham filtered by the GiaNhap column
 * @method     ChildSanpham findOneByLuotxem(int $LuotXem) Return the first ChildSanpham filtered by the LuotXem column *

 * @method     ChildSanpham requirePk($key, ConnectionInterface $con = null) Return the ChildSanpham by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOne(ConnectionInterface $con = null) Return the first ChildSanpham matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSanpham requireOneByMasanpham(int $MaSanpham) Return the first ChildSanpham filtered by the MaSanpham column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByTensanpham(string $TenSanpham) Return the first ChildSanpham filtered by the TenSanpham column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByHinhanh(string $HInhAnh) Return the first ChildSanpham filtered by the HInhAnh column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByGiasp(string $GiaSP) Return the first ChildSanpham filtered by the GiaSP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByDonvitinh(string $DonViTinh) Return the first ChildSanpham filtered by the DonViTinh column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByThongtin(string $ThongTin) Return the first ChildSanpham filtered by the ThongTin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByLoaispMaloaisp(int $LoaiSP_MaLoaiSP) Return the first ChildSanpham filtered by the LoaiSP_MaLoaiSP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByGianhap(string $GiaNhap) Return the first ChildSanpham filtered by the GiaNhap column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSanpham requireOneByLuotxem(int $LuotXem) Return the first ChildSanpham filtered by the LuotXem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSanpham[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSanpham objects based on current ModelCriteria
 * @method     ChildSanpham[]|ObjectCollection findByMasanpham(int $MaSanpham) Return ChildSanpham objects filtered by the MaSanpham column
 * @method     ChildSanpham[]|ObjectCollection findByTensanpham(string $TenSanpham) Return ChildSanpham objects filtered by the TenSanpham column
 * @method     ChildSanpham[]|ObjectCollection findByHinhanh(string $HInhAnh) Return ChildSanpham objects filtered by the HInhAnh column
 * @method     ChildSanpham[]|ObjectCollection findByGiasp(string $GiaSP) Return ChildSanpham objects filtered by the GiaSP column
 * @method     ChildSanpham[]|ObjectCollection findByDonvitinh(string $DonViTinh) Return ChildSanpham objects filtered by the DonViTinh column
 * @method     ChildSanpham[]|ObjectCollection findByThongtin(string $ThongTin) Return ChildSanpham objects filtered by the ThongTin column
 * @method     ChildSanpham[]|ObjectCollection findByLoaispMaloaisp(int $LoaiSP_MaLoaiSP) Return ChildSanpham objects filtered by the LoaiSP_MaLoaiSP column
 * @method     ChildSanpham[]|ObjectCollection findByGianhap(string $GiaNhap) Return ChildSanpham objects filtered by the GiaNhap column
 * @method     ChildSanpham[]|ObjectCollection findByLuotxem(int $LuotXem) Return ChildSanpham objects filtered by the LuotXem column
 * @method     ChildSanpham[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SanphamQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\SanphamQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Sanpham', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSanphamQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSanphamQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSanphamQuery) {
            return $criteria;
        }
        $query = new ChildSanphamQuery();
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
     * @return ChildSanpham|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SanphamTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SanphamTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSanpham A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaSanpham, TenSanpham, HInhAnh, GiaSP, DonViTinh, ThongTin, LoaiSP_MaLoaiSP, GiaNhap, LuotXem FROM Sanpham WHERE MaSanpham = :p0';
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
            /** @var ChildSanpham $obj */
            $obj = new ChildSanpham();
            $obj->hydrate($row);
            SanphamTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSanpham|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaSanpham column
     *
     * Example usage:
     * <code>
     * $query->filterByMasanpham(1234); // WHERE MaSanpham = 1234
     * $query->filterByMasanpham(array(12, 34)); // WHERE MaSanpham IN (12, 34)
     * $query->filterByMasanpham(array('min' => 12)); // WHERE MaSanpham > 12
     * </code>
     *
     * @param     mixed $masanpham The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByMasanpham($masanpham = null, $comparison = null)
    {
        if (is_array($masanpham)) {
            $useMinMax = false;
            if (isset($masanpham['min'])) {
                $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $masanpham['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($masanpham['max'])) {
                $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $masanpham['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $masanpham, $comparison);
    }

    /**
     * Filter the query on the TenSanpham column
     *
     * Example usage:
     * <code>
     * $query->filterByTensanpham('fooValue');   // WHERE TenSanpham = 'fooValue'
     * $query->filterByTensanpham('%fooValue%'); // WHERE TenSanpham LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tensanpham The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByTensanpham($tensanpham = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tensanpham)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tensanpham)) {
                $tensanpham = str_replace('*', '%', $tensanpham);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_TENSANPHAM, $tensanpham, $comparison);
    }

    /**
     * Filter the query on the HInhAnh column
     *
     * Example usage:
     * <code>
     * $query->filterByHinhanh('fooValue');   // WHERE HInhAnh = 'fooValue'
     * $query->filterByHinhanh('%fooValue%'); // WHERE HInhAnh LIKE '%fooValue%'
     * </code>
     *
     * @param     string $hinhanh The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByHinhanh($hinhanh = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hinhanh)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $hinhanh)) {
                $hinhanh = str_replace('*', '%', $hinhanh);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_HINHANH, $hinhanh, $comparison);
    }

    /**
     * Filter the query on the GiaSP column
     *
     * Example usage:
     * <code>
     * $query->filterByGiasp(1234); // WHERE GiaSP = 1234
     * $query->filterByGiasp(array(12, 34)); // WHERE GiaSP IN (12, 34)
     * $query->filterByGiasp(array('min' => 12)); // WHERE GiaSP > 12
     * </code>
     *
     * @param     mixed $giasp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByGiasp($giasp = null, $comparison = null)
    {
        if (is_array($giasp)) {
            $useMinMax = false;
            if (isset($giasp['min'])) {
                $this->addUsingAlias(SanphamTableMap::COL_GIASP, $giasp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($giasp['max'])) {
                $this->addUsingAlias(SanphamTableMap::COL_GIASP, $giasp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_GIASP, $giasp, $comparison);
    }

    /**
     * Filter the query on the DonViTinh column
     *
     * Example usage:
     * <code>
     * $query->filterByDonvitinh('fooValue');   // WHERE DonViTinh = 'fooValue'
     * $query->filterByDonvitinh('%fooValue%'); // WHERE DonViTinh LIKE '%fooValue%'
     * </code>
     *
     * @param     string $donvitinh The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByDonvitinh($donvitinh = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($donvitinh)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $donvitinh)) {
                $donvitinh = str_replace('*', '%', $donvitinh);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_DONVITINH, $donvitinh, $comparison);
    }

    /**
     * Filter the query on the ThongTin column
     *
     * Example usage:
     * <code>
     * $query->filterByThongtin('fooValue');   // WHERE ThongTin = 'fooValue'
     * $query->filterByThongtin('%fooValue%'); // WHERE ThongTin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $thongtin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByThongtin($thongtin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thongtin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $thongtin)) {
                $thongtin = str_replace('*', '%', $thongtin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_THONGTIN, $thongtin, $comparison);
    }

    /**
     * Filter the query on the LoaiSP_MaLoaiSP column
     *
     * Example usage:
     * <code>
     * $query->filterByLoaispMaloaisp(1234); // WHERE LoaiSP_MaLoaiSP = 1234
     * $query->filterByLoaispMaloaisp(array(12, 34)); // WHERE LoaiSP_MaLoaiSP IN (12, 34)
     * $query->filterByLoaispMaloaisp(array('min' => 12)); // WHERE LoaiSP_MaLoaiSP > 12
     * </code>
     *
     * @see       filterByLoaisp()
     *
     * @param     mixed $loaispMaloaisp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByLoaispMaloaisp($loaispMaloaisp = null, $comparison = null)
    {
        if (is_array($loaispMaloaisp)) {
            $useMinMax = false;
            if (isset($loaispMaloaisp['min'])) {
                $this->addUsingAlias(SanphamTableMap::COL_LOAISP_MALOAISP, $loaispMaloaisp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loaispMaloaisp['max'])) {
                $this->addUsingAlias(SanphamTableMap::COL_LOAISP_MALOAISP, $loaispMaloaisp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_LOAISP_MALOAISP, $loaispMaloaisp, $comparison);
    }

    /**
     * Filter the query on the GiaNhap column
     *
     * Example usage:
     * <code>
     * $query->filterByGianhap(1234); // WHERE GiaNhap = 1234
     * $query->filterByGianhap(array(12, 34)); // WHERE GiaNhap IN (12, 34)
     * $query->filterByGianhap(array('min' => 12)); // WHERE GiaNhap > 12
     * </code>
     *
     * @param     mixed $gianhap The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByGianhap($gianhap = null, $comparison = null)
    {
        if (is_array($gianhap)) {
            $useMinMax = false;
            if (isset($gianhap['min'])) {
                $this->addUsingAlias(SanphamTableMap::COL_GIANHAP, $gianhap['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gianhap['max'])) {
                $this->addUsingAlias(SanphamTableMap::COL_GIANHAP, $gianhap['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_GIANHAP, $gianhap, $comparison);
    }

    /**
     * Filter the query on the LuotXem column
     *
     * Example usage:
     * <code>
     * $query->filterByLuotxem(1234); // WHERE LuotXem = 1234
     * $query->filterByLuotxem(array(12, 34)); // WHERE LuotXem IN (12, 34)
     * $query->filterByLuotxem(array('min' => 12)); // WHERE LuotXem > 12
     * </code>
     *
     * @param     mixed $luotxem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByLuotxem($luotxem = null, $comparison = null)
    {
        if (is_array($luotxem)) {
            $useMinMax = false;
            if (isset($luotxem['min'])) {
                $this->addUsingAlias(SanphamTableMap::COL_LUOTXEM, $luotxem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($luotxem['max'])) {
                $this->addUsingAlias(SanphamTableMap::COL_LUOTXEM, $luotxem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SanphamTableMap::COL_LUOTXEM, $luotxem, $comparison);
    }

    /**
     * Filter the query by a related \Model\Loaisp object
     *
     * @param \Model\Loaisp|ObjectCollection $loaisp The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByLoaisp($loaisp, $comparison = null)
    {
        if ($loaisp instanceof \Model\Loaisp) {
            return $this
                ->addUsingAlias(SanphamTableMap::COL_LOAISP_MALOAISP, $loaisp->getMaloaisp(), $comparison);
        } elseif ($loaisp instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SanphamTableMap::COL_LOAISP_MALOAISP, $loaisp->toKeyValue('PrimaryKey', 'Maloaisp'), $comparison);
        } else {
            throw new PropelException('filterByLoaisp() only accepts arguments of type \Model\Loaisp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Loaisp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function joinLoaisp($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Loaisp');

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
            $this->addJoinObject($join, 'Loaisp');
        }

        return $this;
    }

    /**
     * Use the Loaisp relation Loaisp object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\LoaispQuery A secondary query class using the current class as primary query
     */
    public function useLoaispQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLoaisp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Loaisp', '\Model\LoaispQuery');
    }

    /**
     * Filter the query by a related \Model\Ctpdh object
     *
     * @param \Model\Ctpdh|ObjectCollection $ctpdh the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByCtpdh($ctpdh, $comparison = null)
    {
        if ($ctpdh instanceof \Model\Ctpdh) {
            return $this
                ->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $ctpdh->getSanphamMasanpham(), $comparison);
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
     * @return $this|ChildSanphamQuery The current query, for fluid interface
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
     * Filter the query by a related Phieudathang object
     * using the CTPDH table as cross reference
     *
     * @param Phieudathang $phieudathang the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSanphamQuery The current query, for fluid interface
     */
    public function filterByPhieudathang($phieudathang, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCtpdhQuery()
            ->filterByPhieudathang($phieudathang, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSanpham $sanpham Object to remove from the list of results
     *
     * @return $this|ChildSanphamQuery The current query, for fluid interface
     */
    public function prune($sanpham = null)
    {
        if ($sanpham) {
            $this->addUsingAlias(SanphamTableMap::COL_MASANPHAM, $sanpham->getMasanpham(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Sanpham table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SanphamTableMap::clearInstancePool();
            SanphamTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SanphamTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SanphamTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SanphamTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SanphamTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SanphamQuery
