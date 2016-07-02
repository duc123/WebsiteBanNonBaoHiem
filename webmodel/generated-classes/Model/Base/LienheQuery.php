<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Lienhe as ChildLienhe;
use Model\LienheQuery as ChildLienheQuery;
use Model\Map\LienheTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'LienHe' table.
 *
 *
 *
 * @method     ChildLienheQuery orderByMalienhe($order = Criteria::ASC) Order by the MaLienHe column
 * @method     ChildLienheQuery orderByTennguoilh($order = Criteria::ASC) Order by the TenNguoiLH column
 * @method     ChildLienheQuery orderByDienthoai($order = Criteria::ASC) Order by the DienThoai column
 * @method     ChildLienheQuery orderByEmail($order = Criteria::ASC) Order by the Email column
 *
 * @method     ChildLienheQuery groupByMalienhe() Group by the MaLienHe column
 * @method     ChildLienheQuery groupByTennguoilh() Group by the TenNguoiLH column
 * @method     ChildLienheQuery groupByDienthoai() Group by the DienThoai column
 * @method     ChildLienheQuery groupByEmail() Group by the Email column
 *
 * @method     ChildLienheQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLienheQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLienheQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLienheQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLienheQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLienheQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLienhe findOne(ConnectionInterface $con = null) Return the first ChildLienhe matching the query
 * @method     ChildLienhe findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLienhe matching the query, or a new ChildLienhe object populated from the query conditions when no match is found
 *
 * @method     ChildLienhe findOneByMalienhe(int $MaLienHe) Return the first ChildLienhe filtered by the MaLienHe column
 * @method     ChildLienhe findOneByTennguoilh(string $TenNguoiLH) Return the first ChildLienhe filtered by the TenNguoiLH column
 * @method     ChildLienhe findOneByDienthoai(string $DienThoai) Return the first ChildLienhe filtered by the DienThoai column
 * @method     ChildLienhe findOneByEmail(string $Email) Return the first ChildLienhe filtered by the Email column *

 * @method     ChildLienhe requirePk($key, ConnectionInterface $con = null) Return the ChildLienhe by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLienhe requireOne(ConnectionInterface $con = null) Return the first ChildLienhe matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLienhe requireOneByMalienhe(int $MaLienHe) Return the first ChildLienhe filtered by the MaLienHe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLienhe requireOneByTennguoilh(string $TenNguoiLH) Return the first ChildLienhe filtered by the TenNguoiLH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLienhe requireOneByDienthoai(string $DienThoai) Return the first ChildLienhe filtered by the DienThoai column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLienhe requireOneByEmail(string $Email) Return the first ChildLienhe filtered by the Email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLienhe[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLienhe objects based on current ModelCriteria
 * @method     ChildLienhe[]|ObjectCollection findByMalienhe(int $MaLienHe) Return ChildLienhe objects filtered by the MaLienHe column
 * @method     ChildLienhe[]|ObjectCollection findByTennguoilh(string $TenNguoiLH) Return ChildLienhe objects filtered by the TenNguoiLH column
 * @method     ChildLienhe[]|ObjectCollection findByDienthoai(string $DienThoai) Return ChildLienhe objects filtered by the DienThoai column
 * @method     ChildLienhe[]|ObjectCollection findByEmail(string $Email) Return ChildLienhe objects filtered by the Email column
 * @method     ChildLienhe[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LienheQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\LienheQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Lienhe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLienheQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLienheQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLienheQuery) {
            return $criteria;
        }
        $query = new ChildLienheQuery();
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
     * @return ChildLienhe|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LienheTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LienheTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLienhe A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaLienHe, TenNguoiLH, DienThoai, Email FROM LienHe WHERE MaLienHe = :p0';
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
            /** @var ChildLienhe $obj */
            $obj = new ChildLienhe();
            $obj->hydrate($row);
            LienheTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLienhe|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaLienHe column
     *
     * Example usage:
     * <code>
     * $query->filterByMalienhe(1234); // WHERE MaLienHe = 1234
     * $query->filterByMalienhe(array(12, 34)); // WHERE MaLienHe IN (12, 34)
     * $query->filterByMalienhe(array('min' => 12)); // WHERE MaLienHe > 12
     * </code>
     *
     * @param     mixed $malienhe The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByMalienhe($malienhe = null, $comparison = null)
    {
        if (is_array($malienhe)) {
            $useMinMax = false;
            if (isset($malienhe['min'])) {
                $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $malienhe['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($malienhe['max'])) {
                $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $malienhe['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $malienhe, $comparison);
    }

    /**
     * Filter the query on the TenNguoiLH column
     *
     * Example usage:
     * <code>
     * $query->filterByTennguoilh('fooValue');   // WHERE TenNguoiLH = 'fooValue'
     * $query->filterByTennguoilh('%fooValue%'); // WHERE TenNguoiLH LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tennguoilh The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByTennguoilh($tennguoilh = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tennguoilh)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tennguoilh)) {
                $tennguoilh = str_replace('*', '%', $tennguoilh);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LienheTableMap::COL_TENNGUOILH, $tennguoilh, $comparison);
    }

    /**
     * Filter the query on the DienThoai column
     *
     * Example usage:
     * <code>
     * $query->filterByDienthoai('fooValue');   // WHERE DienThoai = 'fooValue'
     * $query->filterByDienthoai('%fooValue%'); // WHERE DienThoai LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dienthoai The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByDienthoai($dienthoai = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dienthoai)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dienthoai)) {
                $dienthoai = str_replace('*', '%', $dienthoai);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LienheTableMap::COL_DIENTHOAI, $dienthoai, $comparison);
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
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LienheTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLienhe $lienhe Object to remove from the list of results
     *
     * @return $this|ChildLienheQuery The current query, for fluid interface
     */
    public function prune($lienhe = null)
    {
        if ($lienhe) {
            $this->addUsingAlias(LienheTableMap::COL_MALIENHE, $lienhe->getMalienhe(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the LienHe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LienheTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LienheTableMap::clearInstancePool();
            LienheTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LienheTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LienheTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LienheTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LienheTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LienheQuery
