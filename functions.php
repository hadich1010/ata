<?php
include('connections.php');

function getTotalCustomers() {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM customers");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['total'];
}

function getActiveCustomers() {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM customers WHERE status = ?");
    $status = 'active';
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['total'];
}

function getLostCustomers() {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM customers WHERE status = ?");
    $status = 'lost';
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['total'];
}

function getCompletedCustomers() {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM customers WHERE status = ?");
    $status = 'completed';
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['total'];
}
?>
