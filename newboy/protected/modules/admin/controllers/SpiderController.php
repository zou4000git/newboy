<?php
Class SpiderController extends Controller
{
    public function curl($url)
    {
        $ch = curl_init();
        $option = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_ENCODING => 'gzip',
        ];

        curl_setopt_array($ch, $option);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function actionIndex()
    {
        $this->renderPartial('index');
    }

    public function actionCkUrls()
    {

        $url = $_GET['url'];
        $urls = $_GET['urls'];
        $allowUrl = $_GET['allowUrl'];
        $urlArr=$this->getUrls($url, $urls, $allowUrl);
        $this->renderPartial('ckUrls', ['result'=>$urlArr]);

    }


    public function actionRun()
    {

        $url = $_GET['url'];
        $urls = $_GET['urls'];
        $allowUrl = $_GET['allowUrl'];
        $title = $_GET['title'];
        $author = $_GET['author'];
        $time = $_GET['time'];
        $content = $_GET['content'];

        $urlArr = $this->getUrls($url, $urls, $allowUrl);
        foreach($urlArr as $k=> $v)
        {

            $html = $this->curl($v);
            if(!$html)
            {
                echo '内容页获取失败';
            }
            else
            {

                $dom = new DOMDocument();
                @$dom->loadHTML($html);
                $dom->normalize();
                $xpath = new DOMXPath($dom);

                $arr = [
                    'title'=>$title,
                    'author'=>$author,
                    'time'=>$time,
                    'content' =>$content,

                ];

                $result = array();
                foreach($arr as $key => $val)
                {
                    $rs = $xpath->query($val);
//                    var_dump($rs);die;
                    if($rs->length!=0)
                    {
                        $str='';
                        for($i=0; $i<$rs->length; $i++)
                        {
                            $str.= $rs->item($i)->nodeValue;
                        }

                        $result[$key] = $str;


                    }
                    else
                    {
                        $result[$key] = 0;
                    }
                }

            }

            $results[] = $result;

        }

        $jsonRes = json_encode($results);

        $this->renderPartial('run', ['results'=>$results, 'jsonRes'=>$jsonRes]);



    }



    public function getUrls($url, $urls, $allowUrl)
    {
        $html = $this->curl($url);
        if(!$html)
        {
            die("页面打不开");
        }
        else
        {
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $dom->normalize();

            $xpath = new DOMXPath($dom);
            $rs = $xpath->query($urls);

            try
            {
                if($rs->length!=0)
                {
                    for($i=0; $i<$rs->length; $i++)
                    {
                        $result[] = $allowUrl.$rs->item($i)->nodeValue;
                    }
                    return $result;
                }
                else
                {
                    throw new Exception('获取url列表失败');
                }
            }
            catch (Exception $e)
            {
                die($e->getMessage());
            }

        }

    }

    public function actionAdd()
    {
        $lib = $_POST['lib'];

        $str = str_replace('&quot;', '"', $_POST['json']);

        //$str = $_POST['json'];
        //echo $str;die;
        $arr = json_decode($str, 1);
        if(!$arr)
        {

            die('接收数据失败……');
        }
        else
        {
            file_put_contents('sss.txt', $str);

        }

    }

}