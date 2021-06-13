<?php 
    require_once(__DIR__ . '/vendor/autoload.php');
    use \Mailjet\Resources;
   
    $mj = new \Mailjet\Client('d5b5a3c3031da315bcba282b51e89177', 'ea7bb022c8b9a073b7d04969f7f81d58',true,['version' => 'v3.1']);


    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $body = [
                'Messages' => [
                  [
                    'From' => [
                      'Email' => "saintsuperylucas@gmail.com",
                      'Name' => "Lucas"
                    ],
                    'To' => [
                      [
                        'Email' => "saintsuperylucas@gmail.com",
                        'Name' => "Lucas"
                      ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "$email, $message",
                    
                    'CustomID' => "AppGettingStartedTest"
                  ]
                ]
              ];
              $response = $mj->post(Resources::$Email, ['body' => $body]);
              $response->success() && var_dump($response->getData());
            echo "Email envoyé avec succès !";
        }
        else{
            echo "Email non valide";
            header('Location: index.html');
            die()
        }

    }  
    ?>