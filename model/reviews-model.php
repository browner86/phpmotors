<?php
//customer reviews model.
function insertReview($reviewText, $reviewDate, $invId, $clientId ){
    // adds customer review to database
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews
                (reviewText
                ,reviewDate
                ,invId
                ,clientId)
            VALUES
                (:reviewText
                ,:reviewDate
                ,:invId
                ,:clientId)';
    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':reviewText' , $reviewText   , PDO::PARAM_STR);
    $stmt-> bindValue(':invId'      , $invId        , PDO::PARAM_INT);
    $stmt-> bindValue(':clientId'   , $clientId     , PDO::PARAM_INT);
    $stmt-> bindValue(':reviewDate' , $reviewDate   , PDO::PARAM_STR);
    $stmt-> execute();
    $rowsChanged = $stmt->rowCount(); 
    $stmt->closeCursor(); 
    return $rowsChanged;

}

function getReviewsByInventoryItem($invId){
    $db = phpmotorsConnect(); 
    $sql = "SELECT   *
                    -- reviewId
                    -- , reviewText
                    -- , DATE_FORMAT(reviewDate, '%Y-%m-%d %H:%i:%s')
                    -- , invId
                    -- , clientId

            FROM reviews 
            WHERE invId = :invId 
            ORDER BY reviewDate DESC";
            
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
       
    }

function getReviewsByClient($clientId){
    $db = phpmotorsConnect(); 
    $sql = "SELECT r.reviewId
                ,r.reviewText
                ,r.reviewDate
                ,r.invId
                ,r.clientId
                ,i.invMake
                ,i.invModel
            FROM reviews r
            JOIN inventory i
            ON r.invId = i.invId 
            WHERE clientId = :clientId 
            ORDER BY r.reviewDate DESC"
            ;
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $reviews; 
}

function getReview($reviewId){
    // var_dump($reviewId);
    // exit;
    $db = phpmotorsConnect();
    $sql = "SELECT r.reviewId
                ,r.reviewText
                ,r.reviewDate
                ,r.invId
                ,r.clientId
                ,i.invMake
                ,i.invModel
            FROM reviews r
            JOIN inventory i
            ON r.invId = i.invId
            WHERE reviewId = :reviewId";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewInfo;
}

function updateReview($reviewId,$reviewText,$reviewDate){
    // var_dump($reviewId,$reviewText);
    // exit;
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews
            SET  reviewText = :reviewText
                ,reviewDate = :reviewDate
            WHERE reviewId = :reviewId;';
    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':reviewText' , $reviewText   , PDO::PARAM_STR);
    $stmt-> bindValue(':reviewId'   , $reviewId     , PDO::PARAM_INT);
    $stmt-> bindValue(':reviewDate' , $reviewDate   , PDO::PARAM_STR);


    $stmt-> execute();
    $rowsChanged = $stmt->rowCount(); 
    $stmt->closeCursor(); 
    return $rowsChanged;
}

function deleteReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews
            WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':reviewId', $reviewId , PDO::PARAM_INT);
    $stmt-> execute();
    $rowsChanged = $stmt->rowCount(); 
    $stmt->closeCursor(); 
    return $rowsChanged;
}