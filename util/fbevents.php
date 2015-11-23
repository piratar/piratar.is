<?php 

    require_once __DIR__ . '/vendor/autoload.php';
    $config = json_decode(file_get_contents(__DIR__ . '/config.json'),false);

    $fb = new Facebook\Facebook([
        'app_id' => $config->fb->app_id,
        'app_secret' => $config->fb->app_secret,
        'default_graph_version' => 'v2.2',
    ]);
 
    $response =  $fb->get('/Piratar.Island/events?since='.strtotime("-2 day"),$config->fb->access_token);
    $graphObject = $response->getGraphEdge();
    $obj = json_decode($graphObject);
    
    $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s',$config->db->hostname, $config->db->database),
                   $config->db->user, $config->db->password);

    $pre = $pdo->prepare(sprintf('delete from %s.%s where user_id = :user_id or start >= :yesterday',$config->db->database, $config->db->tablename));
    $pre->execute([':user_id'=>$config->db->user_id, 'yesterday'=>date("Y-m-d",strtotime("-1 day"))]);
    $pre = $pdo->prepare(sprintf('insert into %s.%s(id, title, venue, address, city, zip, country, start, end, description, link, user_id) values
                         (:id, :title, :venue, :address, :city, :zip, :country, :start, :end, :description, :link, :user_id)',
                         $config->db->database, $config->db->tablename, $config->db->user_id));
//    print(date( "Y-m-d",strtotime("-2 day")));
    
    $e = [];
    foreach ($obj as $event ) {
        $e['start'] = $event->start_time->date;
        $e['end'] = (property_exists($event, 'end_time') ? $event->end_time->date: '');
        $e['name'] = $event->name;
        $e['description'] = (property_exists($event, 'description') ? $event->description: '');
        $e['place'] = (property_exists($event, 'place') ? $event->place->name: '');
        $e['address'] = (property_exists($event, 'place') ? $event->place->location->street: 'x');
        $e['city'] = (property_exists($event, 'place') ? $event->place->location->city: 'x');
        $e['zip'] = (property_exists($event, 'place') ? $event->place->location->zip: 'x');
        $e['id'] = $event->id;
        $e['country'] = (property_exists($event, 'place') ? $event->place->location->country: 'x');
        $e['link'] = $config->fb->event_url_prefix . $event->id;
        $pre->execute([':id'=>$e['id'], ':title'=>utf8_decode($e['name']), ':venue'=>utf8_decode($e['place']),
                       ':address'=>utf8_decode($e['address']), ':city'=>utf8_decode($e['city']), ':zip'=>$e['zip'], 
                       ':country'=>$e['country'], ':start'=>$e['start'], ':end'=>$e['end'], ':description'=>utf8_decode($e['description']),
                       ':link'=>$e['link'], ':user_id'=>$config->db->user_id]);
    }

?>
