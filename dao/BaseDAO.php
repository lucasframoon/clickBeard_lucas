<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/DBControl.php');

class BaseDAO
{

    protected $connection;

    protected function getListCast($query)
    {

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        $array = array();

        foreach ($result as $item) {
            $array[] = $this->processRow($item);
        }

        return $array;
    }

    protected function getListCastParam($query, $param)
    {

        $stmt = $this->connection->prepare($query);

        foreach (array_keys($param) as $id) {
            $stmt->bindParam($id, $param[$id]);
        }

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        $array = array();

        foreach ($result as $item) {
            $array[] = $this->processRow($item);
        }

        return $array;
    }

    protected function getItemCast($query)
    {

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $this->processRow($stmt->fetch());
    }

    protected function getItemCastParam($query, $param)
    {


        $stmt = $this->connection->prepare($query);

        foreach (array_keys($param) as $id) {
            $stmt->bindParam($id, $param[$id]);
        }

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $this->processRow($stmt->fetch());
    }

    protected function getListNoCast($query)
    {

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getListNoCastParam($query, $param)
    {

        $stmt = $this->connection->prepare($query);

        foreach (array_keys($param) as $id) {
            $stmt->bindParam($id, $param[$id]);
        }

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getItemNoCast($query)
    {
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
    }

    protected function getItemNoCastParam($query, $param)
    {


        $stmt = $this->connection->prepare($query);

        foreach (array_keys($param) as $id) {
            $stmt->bindParam($id, $param[$id]);
        }

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
    }

    protected function processRow($rs)
    {
        return $rs;
    }


    protected function processRowNoCast($rs)
    {
        return $rs;
    }

    protected function insertItem($query, $param)
    {

        try {

            $id = 0;

            $stmt = $this->connection->prepare($query);

            foreach (array_keys($param) as $id) {
                // echo '<br>' . $id . ' - ' . $param[$id] . '</br>';
                $stmt->bindParam($id, $param[$id]);
            }

            $stmt->execute();

            $id = $this->connection->lastInsertId();
        } catch (Exception $e) {
            throw  $e;
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }

        return $id;
    }

    protected function updateItem($query, $param)
    {

        try {
            $stmt = $this->connection->prepare($query);

            foreach (array_keys($param) as $id) {
                $stmt->bindParam($id, $param[$id]);
            }



            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
            //var_dump($e->getMessage());
        }
    }

    protected function deleteItem($query, $param)
    {

        $count = 0;

        try {

            $stmt = $this->connection->prepare($query);

            foreach (array_keys($param) as $id) {
                $stmt->bindParam($id, $param[$id]);
            }

            $stmt->execute();

            $count = $stmt->rowCount();
        } catch (Exception $e) {
            throw $e;
        }

        return $count;
    }


    protected function executeItem($query, $param)
    {

        $count = 0;

        try {

            $stmt = $this->connection->prepare($query);

            foreach (array_keys($param) as $id) {
                $stmt->bindParam($id, $param[$id]);
            }

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }

        return $count;
    }

    protected function executeQuery($query)
    {

        try {

            $stmt = $this->connection->prepare($query);

            return $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function insertQuery($query)
    {

        try {
            $id = 0;

            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            $id = $this->connection->lastInsertId();

            return $id;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
