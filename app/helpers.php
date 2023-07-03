<?php
use App\Models\Setting;
use App\Models\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if(!function_exists('blogInfo')){
    function blogInfo(){
        return Setting::find(1);
    }
}

if(!function_exists('date_formatter')){
    function date_formatter($date){
        return Carbon::createFromFormat('Y-m-d H:i:s',$date)->locale('pt_PT')->isoFormat('LL');
    }
}

if(!function_exists('words')){
function words($value, $words=15, $end="..."){
    return Str::words(strip_tags($value),$words,$end);
} 
}


if(function_exists('isOnline')){
    function isOnline($site ="https://youtube.com/"){
     if(@fopen($site, "r")){
        return true;
     }else{
        return false;
     }
    }
}

if(!function_exists('readDuration')){
    function readDuration(...$text){
     Str::macro('timeCounter', function($text){
       $totalWords=str_word_count(implode(" ",$text));
       $minutesToRead=round($totalWords/200);
       return (int)max(1,$minutesToRead);
     });
     return Str::timeCounter($text);

    }
}

if(!function_exists('single_latest_post')){
    function single_latest_post(){
        return Post::with('author')
        ->with('subcategoria')
        ->limit(1)
        ->orderBy('created_at', 'desc')
        ->first();
    } 
    }


    if(!function_exists('latest_home_6post')){
        function latest_home_6post(){
            return Post::with('author')
            ->with('subcategoria')
            ->skip(1)
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();
        } 
        }

        if(!function_exists('recommended_post')){
            function recommended_post(){
                return Post::with('author')
                ->with('subcategoria')
                ->limit(4)
                ->inRandomOrder()
                ->get();
            } 
            }


            if(!function_exists('categorias')){
                function categorias(){
                    return Subcategoria::whereHas('posts')
                    ->with('posts')
                    ->orderBy('nome_subcategoria', 'asc')
                    ->get();
                } 
                }       

           if(!function_exists('latest_sidebar_posts')){
              function latest_sidebar_posts($except=null, $limit=4){
                return Post::where('id','!=',$except)
                            ->limit($limit)
                            ->orderBy('created_at','desc')
                            ->get();
              } 
           }

           if(!function_exists('sendMail')){
            function sendMail($mailConfig){
             
                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';

                $mail=new PHPMailer(true);
                $mail->SMTPDebug=0;
                $mail->isSMTP();
                $mail->Host=env('EMAIL_HOST');
                $mail->SMTPAuth=true;
                $mail->Username=env('EMAIL_USERNAME');
                $mail->Password=env('EMAIL_PASSWORD');
                $mail->SMTPSecure=env('EMAIL_ENCRYPTION');
                $mail->Port = env('EMAIL_PORT');
                $mail->setFrom($mailConfig['mail_from_email'],$mailConfig['mail_from_name']);

                $mail->addAddress($mailConfig['mail_recipient_email'],$mailConfig['mail_recipient_name']);
                $mail->isHTML(true);
                $mail->Subject=$mailConfig['mail_subject'];
                $mail->Body=$mailConfig['mail_body'];

                if($mail->send()){
                    return true;
                }else{
                    return false;
                }
                
            }

           }

?>


