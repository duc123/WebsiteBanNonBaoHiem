<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Phanhoi as ChildPhanhoi;
use Model\PhanhoiQuery as ChildPhanhoiQuery;
use Model\Map\PhanhoiTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'PhanHoi' table.
 *
 *
 *
 * @method     ChildPhanhoiQuery orderByMaph($order = Criteria::ASC) Order by the MaPH column
 * @method     ChildPhanhoiQuery orderByTennguoiph($order = Criteria::ASC) Order by the TenNguoiPH column
 * @method     ChildPhanhoiQuery orderByEmail($order = Criteria::ASC) Order by the Email column
 * @method     ChildPhanhoiQuery orderByNoidung($order = Criteria::ASC) Order by the NoiDung column
 *
 * @method     ChildPhanhoiQuery groupByMaph() Group by the MaPH column
 * @method     ChildPhanhoiQuery groupByTennguoiph() Group by the TenNguoiPH column
 * @method     ChildPhanhoiQuery groupByEmail() Group by the Email column
 * @method     ChildPhanhoiQuery groupByNoidung() Group by the NoiDung column
 *
 * @method     ChildPhanhoiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPhanhoiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPhanhoiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPhanhoiQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPhanhoiQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPhanhoiQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPhanhoi findOne(ConnectionInterface $con = null) Return the first ChildPhanhoi matching the query
 * @method     ChildPhanhoi findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPhanhoi matching the query, or a new ChildPhanhoi object populated from the query conditions when no match is found
 *
 * @method     ChildPhanhoi findOneByMaph(int $MaPH) Return the first ChildPhanhoi filtered by the MaPH column
 * @method     ChildPhanhoi findOneByTennguoiph(string $TenNguoiPH) Return the first ChildPhanhoi filtered by the TenNguoiPH column
 * @method     ChildPhanhoi findOneByEmail(string $Email) Return the first ChildPhanhoi filtered by the Email column
 * @method     ChildPhanhoi findOneByNoidung(string $NoiDung) Return the first ChildPhanhoi filtered by the NoiDung column *

 * @method     ChildPhanhoi requirePk($key, ConnectionInterface $con = null) Return the ChildPhanhoi by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhanhoi requireOne(ConnectionInterface $con = null) Return the first ChildPhanhoi matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhanhoi requireOneByMaph(int $MaPH) Return the first ChildPhanhoi filtered by the MaPH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhanhoi requireOneByTennguoiph(string $TenNguoiPH) Return the first ChildPhanhoi filtered by the TenNguoiPH column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhanhoi requireOneByEmail(string $Email) Return the first ChildPhanhoi filtered by the Email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhanhoi requireOneByNoidung(string $NoiDung) Return the first ChildPhanhoi filtered by the NoiDung column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhanhoi[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPhanhoi objects based on current ModelCriteria
 * @method     ChildPhanhoi[]|ObjectCollection findByMaph(int $MaPH) Return ChildPhanhoi objects filtered by the MaPH column
 * @method     ChildPhanhoi[]|ObjectCollection findByTennguoiph(string $TenNguoiPH) Return ChildPhanhoi objects filtered by the TenNguoiPH column
 * @method     ChildPhanhoi[]|ObjectCollection findByEmail(string $Email) Return ChildPhanhoi objects filtered by the Email column
 * @method     ChildPhanhoi[]|ObjectCollection findByNoidung(string $NoiDung) Return ChildPhanhoi objects filtered by the NoiDung column
 * @method     ChildPhanhoi[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PhanhoiQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\PhanhoiQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'quanlybanhang', $modelName = '\\Model\\Phanhoi', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPhanhoiQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPhanhoiQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPhanhoiQuery) {
            return $criteria;
        }
        $query = new ChildPhanhoiQuery();
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
     * @return ChildPhanhoi|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PhanhoiTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PhanhoiTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPhanhoi A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MaPH, TenNguoiPH, Email, NoiDung FROM PhanHoi WHERE MaPH = :p0';
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
            /** @var ChildPhanhoi $obj */
            $obj = new ChildPhanhoi();
            $obj->hydrate($row);
            PhanhoiTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPhanhoi|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MaPH column
     *
     * Example usage:
     * <code>
     * $query->filterByMaph(1234); // WHERE MaPH = 1234
     * $query->filterByMaph(array(12, 34)); // WHERE MaPH IN (12, 34)
     * $query->filterByMaph(array('min' => 12)); // WHERE MaPH > 12
     * </code>
     *
     * @param     mixed $maph The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function filterByMaph($maph = null, $comparison = null)
    {
        if (is_array($maph)) {
            $useMinMax = false;
            if (isset($maph['min'])) {
                $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $maph['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maph['max'])) {
                $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $maph['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $maph, $comparison);
    }

    /**
     * Filter the query on the TenNguoiPH column
     *
     * Example usage:
     * <code>
     * $query->filterByTennguoiph('fooValue');   // WHERE TenNguoiPH = 'fooValue'
     * $query->filterByTennguoiph('%fooValue%'); // WHERE TenNguoiPH LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tennguoiph The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function filterByTennguoiph($tennguoiph = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tennguoiph)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tennguoiph)) {
                $tennguoiph = str_replace('*', '%', $tennguoiph);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhanhoiTableMap::COL_TENNGUOIPH, $tennguoiph, $comparison);
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
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PhanhoiTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the NoiDung column
     *
     * Example usage:
     * <code>
     * $query->filterByNoidung('fooValue');   // WHERE NoiDung = 'fooValue'
     * $query->filterByNoidung('%fooValue%'); // WHERE NoiDung LIKE '%fooValue%'
     * </code>
     *
     * @param     string $noidung The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function filterByNoidung($noidung = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($noidung)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $noidung)) {
                $noidung = str_replace('*', '%', $noidung);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhanhoiTableMap::COL_NOIDUNG, $noidung, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPhanhoi $phanhoi Object to remove from the list of results
     *
     * @return $this|ChildPhanhoiQuery The current query, for fluid interface
     */
    public function prune($phanhoi = null)
    {
        if ($phanhoi) {
            $this->addUsingAlias(PhanhoiTableMap::COL_MAPH, $phanhoi->getMaph(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the PhanHoi table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhanhoiTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PhanhoiTableMap::clearInstancePool();
            PhanhoiTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PhanhoiTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PhanhoiTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PhanhoiTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PhanhoiTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PhanhoiQuery
