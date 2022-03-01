<?php
class Shop_model extends CI_Model
{
    function existsb($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('nguoidung');
        return $query->num_rows();
    }

    function insertdb($data)
    {
        $this->db->insert('nguoidung',$data);
    }

    function updatedb($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('nguoidung',$data);
    }

    function checkUser($id,$email,$name)
    {
        if($this->existsb($id) > 0)
        {
            $data = ['id' => $id, 'email' => $email, 'name' => $name, 'trangthai' => 0];
            $this->updatedb($id, $data);
        }else{
            $data = array('id' => $id, 'name' => $name,'email' => $email,'cash' => 0,'trangthai' => 1);
            $this->insertdb($data);
        }
        $this->db->where('id',$id);
        $qa = $this->db->get('nguoidung');
        return $qa->result_array();
    }

    function getAmungStats($amung) {
        if(!isset($amung)) return false;

        $url = 'http://whos.amung.us/sitecount/' . $amung . '/';
        $result = '';
        if (function_exists('curl_init')) {
            $http_headers                           = array();
            $http_headers[]                         = 'Expect:';
            $http_headers[]                         = 'Content-Type: text/plain';
            $http_headers[]                         = 'Host: whos.amung.us';
            $opts                                   = array();
            $opts[CURLOPT_URL]                      = $url;
            $opts[CURLOPT_HTTPHEADER]               = $http_headers;
            $opts[CURLOPT_CONNECTTIMEOUT]           = 5;
            $opts[CURLOPT_TIMEOUT]                  = 10;
            $opts[CURLOPT_USERAGENT]                = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17';
            $opts[CURLOPT_HEADER]                   = FALSE;
            $opts[CURLOPT_RETURNTRANSFER]           = TRUE;

            # Initialize PHP/CURL handle
            $ch = curl_init();
            curl_setopt_array($ch, $opts);
            # Create return array
            $result = curl_exec($ch);
            curl_close($ch);
        } elseif (ini_get('allow_url_fopen')) {
            $result = file_get_contents($url);
        }

        return intval($result);
    }
}