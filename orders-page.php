<?php
$header = "Заказы";
include 'components/header.php';
include 'pdo-connect/orders-info.php';
include 'pdo-connect/orders-product.php';
if ($_SESSION['user']['role'] != 'admin'){
    header('Location: index.php');
}
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$perPage = 10;

$start = ($currentPage - 1) * $perPage;
$end = $start + $perPage;

$ordersSubset = array_slice($orders, $start, $perPage);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id']) && isset($_POST['status'])) {
        $orderID = $_POST['order_id'];
        $newStatus = $_POST['status'];

        $sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
        $statement = $PDO->prepare($sql);
        $statement->bindParam(':status', $newStatus);
        $statement->bindParam(':order_id', $orderID);
        $statement->execute();

        header('Location: '.$_SERVER['PHP_SELF'].'?page='.$currentPage);
        exit();
    }
   
}
?>
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>В заказе</th>
                <th>Общая сумма</th>
                <th>Статус</th>
        </tr>
    </thead>
    <tbody>  
        <?php
            foreach ($ordersSubset as $order):
                ?>
                    <tr class="<?php 
                            if ($order['status'] == 'completed')
                                echo 'completed';
                            if ($order['status'] == 'cancelled')
                                echo 'cancelled';
                        ?>">
                        <td><?=$order['order_id']?></td>
                        <td><?=$order['client_name']?></td>
                        <td>
                        <?php
                        foreach ($products_in_order as $pio):
                            if ($order['order_id'] == $pio['order_id']){
                                echo $pio['product_name'].' x '.$pio['quantity'].' - '.$pio['summa'].' р. <br>';
                            }
                        endforeach;
                            ?>
                        </td>
                        <td><?=$order['summa_order']?> р.</td>
                        <td >
                            <form class="flex" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $currentPage ?>">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <select class="form-control" name="status">
                                    <?php 
                                        if ($order['status'] == 'completed'){
                                        ?>
                                            <option value="completed">Выполнен</option>
                                            <option value="cancelled">Отменен</option>
                                            <option value="work">В работе</option>
                                        <?php 
                                        }
                                        if ($order['status'] == 'cancelled'){
                                        ?>
                                            <option value="cancelled">Отменен</option>
                                            <option value="completed">Выполнен</option>
                                            <option value="work">В работе</option>
                                        <?php
                                        }
                                        if ($order['status'] == 'work'){
                                            ?>
                                                <option value="work">В работе</option>
                                                <option value="cancelled">Отменен</option>
                                                <option value="completed">Выполнен</option>
                                            <?php
                                        } 
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-light">✓</button>
                            </form>
                        </td>
                    </tr>
                <?php
            endforeach;
        ?>
    </tbody> 
</table> 

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
        $totalPages = ceil(count($orders) / $perPage);

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;

        $nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages;

        echo '<li class="page-item"><a class="page-link" href="?page=' . $prevPage . '">Назад</a></li>';

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($currentPage == $i) ? 'active' : '';
            echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPage . '">Вперёд</a></li>';
        ?>
    </ul>
</nav>

<?php
include 'components/footer.php'
?>