<?php
Class SController extends Controller
{
    /**
     * @param $url
     * @return mixed
     * 执行curl
     */
    public function curl($url)
    {
        $ch = curl_init();
        $option = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_TIMEOUT => 5,
        ];
        curl_setopt_array($ch,$option);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @throws CException
     * 页面展示
     */
    public function actionPhp()
    {
      // header('Content-type:text/html;charset=utf-8');
        if($_POST)
        {
            $url = $_POST['url'];
            $urls =  $_POST['urls'];
            $item = $_POST['item'];
            $allowUrl = $_POST['allowUrl'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $time = $_POST['time'];
            $content = $_POST['content'];

            $urls = $this->getUrls($url, $urls, $item);
            //var_Dump($urls);die;
            $contents = $this->getContents($urls, $allowUrl, $title, $author, $time, $content);

            $this->renderPartial('phpResult', ['contents'=>$contents]);
//            echo "<pre>";
//            var_dump($contents);
        }
        else
        {
            $this->renderPartial('php');
        }

    }

    public function actionPhpResult()
    {
       $this->renderPartial('phpResult');
    }





    public function getUrls($url, $urls, $item)
    {
        $html = $this->curl($url);
        //echo $html;die;
        preg_match("#$urls#is", $html, $matches);
        //var_dump($matches);die;
        $urlStr =  $matches[0];
        preg_match_all("#$item#is", $urlStr, $matches);

        return $matches[1];

    }

    public function getContents($urls,$allowUrl,$title,$author,$time,$content)
    {
        foreach($urls as $k => $v)
        {
            $html = $this->curl($allowUrl.$v);

            $pattern = [

//                'title' => '#<div class="title"><h1>(.*?)</h1></div>#is',
//                'author' => '#<div class="info"><small>.*?</small>(.*?)<small>.*?</small>.*?<script>#is',
//                'time' => '#<div class="info"><small>.*?</small>.*?<small>.*?</small>(.*?)<script>#is',
//                'content' => '#<div id="arctext" class="content 2">(.*?)</div>#is',
                'title' => "#$title#is",
                'author' => "#$author#is",
                'time' => "#$time#is",
                'content' => "#$content#is",

            ];

            foreach($pattern as $key => $val)
            {
                preg_match($val, $html, $matches);
                if($matches)
                {
                    $result[$key] = $matches[1];
                }
                else
                {
                    $result[$key] = "error: unable to extract $key";
                }


            }
            $results[] = $result;
        }
        return $results;
    }


}
