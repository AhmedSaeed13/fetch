<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://instagram-scraper-api2.p.rapidapi.com/v1/posts?username_or_id_or_url={$username}&url_embed_safe=true",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: instagram-scraper-api2.p.rapidapi.com",
            "x-rapidapi-key: 1fcb997f25mshbde5dfeab9feabdp177c57jsn49ab5784887c"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo json_encode(['error' => "cURL Error #:" . $err]);
    } else {
        $data = json_decode($response, true);
        if (isset($data['data'])) {
            echo json_encode($data['data']);
        } else {
            echo json_encode(['error' => 'No posts found']);
        }
    }
} else {
    echo json_encode(['error' => 'Username not provided']);
}
?>