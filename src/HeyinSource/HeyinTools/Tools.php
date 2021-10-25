<?php

namespace HeyinSource\HeyinTools;


/**
 * 系统工具类（与业务无关）
 * Class Tools
 * @package app\librarys
 */
class Tools
{
    /**
     * 获取当前系统时间(精确到毫秒)
     * @return float
     */
    public static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    /**
     * 获取当前系统时间(精确到微秒)
     * @return float
     */
    public static function getMicrosecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000000);
    }

    /**
     * 毫秒日期加法
     * @param mixed $time 原时间（毫秒）
     * @param int $interval_time 增加时间（秒）
     * @return string
     */
    public static function millisecondAddSecondTime($time, $interval_time)
    {
        $interval_time = floatval($interval_time * 1000);
        $mescdate = self::getDateToMesc($time) + $interval_time;
        return self::getMsecToMescdate($mescdate);
    }

    /**
     * 毫秒转日期
     */
    public static function getMsecToMescdate($msectime)
    {
        $msectime = $msectime * 0.001;
        if (strstr($msectime, '.')) {
            sprintf("%01.3f", $msectime);
            list($usec, $sec) = explode(".", $msectime);
            $sec = str_pad($sec, 3, "0", STR_PAD_RIGHT);
        } else {
            $usec = $msectime;
            $sec = "000";
        }
        $date = date("Y-m-d H:i:s.x", $usec);
        return str_replace('x', $sec, $date);
    }

    /**
     * 日期转毫秒
     * @param $mescdate
     * @return float
     */
    public static function getDateToMesc($mescdate)
    {
        if (!strstr($mescdate, '.')) {
            $mescdate .= '.000';
        }

        list($usec, $sec) = explode(".", $mescdate);
        $date = strtotime($usec);
        $return_data = str_pad($date . $sec, 13, "0", STR_PAD_RIGHT);
        return floatval($return_data);
    }

    /**
     * 获取当前数据库时间（毫秒）
     * @return false|null|string
     */
    public static function getDbNowTime($m_seconds = 3)
    {
        $sql = "SELECT NOW({$m_seconds});";
        $cmd = \Yii::$app->db->createCommand($sql);
        return $cmd->queryScalar();
    }

    /**
     * 查询固定格式的日期
     * @param string $format
     * @return false|null|string
     */
    public static function getDbNowFormatDate($format = '%y%m%d')
    {
        $sql = 'SELECT DATE_FORMAT(NOW(),:format);';

        $cmd = \Yii::$app->db->createCommand($sql);
        $cmd->bindValue(':format', $format);
        return $cmd->queryScalar();
    }

    /**
     * 获取微秒级的日期
     * @return string
     */
    public static function getCurrentMicroDatetime()
    {
        $micro = self::getMicrosecond();// 获取微秒
        $second = $micro / 1000000;// 微秒转秒
        $arr = explode('.', $second);
        return date('Y-m-d H:i:s', $arr[0]) . '.' . ($arr[1] ?? '000000');
    }

    /**
     * POST请求Json
     * @param string $url
     * @param mixed $data
     * @param bool $JSON_UNESCAPED_UNICODE
     * @return string
     */
    public static function postJson($url, $data, $JSON_UNESCAPED_UNICODE = false)
    {
        if ($JSON_UNESCAPED_UNICODE) {
            $data_string = json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            $data_string = json_encode($data);
        }
        $ch = curl_init($url);
        //https 请求
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'charset=utf-8',)

        );

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * POST提交表单请求
     * @param string $url
     * @param mixed $data
     * @return string
     */
    public static function postForm($url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    /**
     * 调用系统api（已进行签名处理）
     * @param string $url
     * @param string $account
     * @param string $token
     * @param mixed $post_params
     * @param null|string $verify
     * @return string
     */
    public static function postApi($url, $account, $token, $post_params, $verify = null)
    {
        if ($verify == null) {
            $verify = self::getRandomString(8);
        }
        $timestamp = (string)time();

        $sign = strtolower(md5($account . $token . $timestamp . $verify));

        if (isset($post_params) && count($post_params) > 0) {
            Tools::arraySort($post_params);
            $post_sign = strtolower(md5(json_encode($post_params) . $token));

            $post_params['sign'] = $post_sign;
        }

        $url = $url . '?account=' . $account . '&timestamp=' . $timestamp . '&verify=' . $verify . '&sign=' . $sign;

        return self::postJson($url, $post_params);
    }

    /**
     * 调用系统api（已进行签名处理） 用于和掌柜
     * @param string $url
     * @param string $account
     * @param string $token
     * @param mixed $post_params
     * @param null|string $verify
     * @return string
     */
    public static function getSignInfo($url, $account, $token, $verify = null)
    {
        if ($verify == null) {
            $verify = self::getRandomString(8);
        }
        $timestamp = (string)time();

        $sign = strtolower(md5($account . $token . $timestamp . $verify));
//
//        if (isset($post_params) && count($post_params) > 0) {
//            Tools::arraySort($post_params);
//            $post_sign = strtolower(md5(json_encode($post_params) . $token));
//
//            $post_params['sign'] = $post_sign;
//        }

        $url = $url . '?account=' . $account . '&timestamp=' . $timestamp . '&verify=' . $verify . '&sign=' . $sign;

        return $url;
    }

    /**
     * 调用系统api（已进行签名处理） 用于集采云
     * @param string $url
     * @param string $account
     * @param string $token
     * @param mixed $post_params
     * @param null|string $verify
     * @return string
     */
    public static function getSignMallInfo($url, $account, $token, $params = "", $verify = null, $type = 1)
    {
        if ($verify == null) {
            $verify = self::getRandomString(8);
        }
        $timestamp = (string)time();
        $sign = strtolower(md5($account . $timestamp . $token . $verify));
//
//        if (isset($post_params) && count($post_params) > 0) {
//            Tools::arraySort($post_params);
//            $post_sign = strtolower(md5(json_encode($post_params) . $token));
//
//            $post_params['sign'] = $post_sign;
//        }

        $url = $url . '?account=' . $account . '&timestamp=' . $timestamp . '&verify=' . $verify . '&sign=' . $sign . $params;
        if ($type == 1) {
            return $url;
        } else {
            return self::postJson($url, []);
        }
    }

    /**
     * 获取当前站点的web根目录（自动判断index.php是否隐藏）
     * @return mixed|string
     */
    public static function urlBase()
    {
        if (\Yii::$app->urlManager->showScriptName == true) {
            $url = \Yii::$app->request->scriptUrl;
        } else {
            $url = Url::base();
        }
        return $url;
    }

    /**
     * 注意是 取反的
     * 取正是 Tools中的urlBase()
     * 获取当前站点的web根目录（自动判断index.php是否隐藏）
     * @return mixed|string
     */
    public static function urlBaseToFalse()
    {
        if (\Yii::$app->urlManager->showScriptName == false) {
            $url = \Yii::$app->request->scriptUrl;
        } else {
            $url = Url::base();
        }
        return $url;
    }

    /**
     * 产生uuid（xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx）
     * @param string $prefix 前缀
     * @return string
     */
    public static function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8) . '-';
        $uuid .= substr($chars, 8, 4) . '-';
        $uuid .= substr($chars, 12, 4) . '-';
        $uuid .= substr($chars, 16, 4) . '-';
        $uuid .= substr($chars, 20, 12);
        return $prefix . $uuid;
    }

    /**
     * 产生数据库uuid
     * @return string
     */
    public static function db_uuid()
    {
        $cmd = \Yii::$app->db->createCommand("select uuid();");
        return $cmd->queryScalar();
    }

    /**
     * 获取随机字符串
     * @param int $len 字符串长度
     * @param string $chars 字符池（默认为大小写+数字）
     * @return string
     */
    public static function getRandomString($len, $chars = null)
    {
        if (is_null($chars)) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    /**
     * 获取完整的Exception Full Trace信息
     * @param \Exception $exception
     * @return string
     */
    public static function getExceptionFullTraceAsString($exception)
    {
        $rtn = "";
        try {
            $count = 0;
            foreach ($exception->getTrace() as $frame) {
                $args = "";
                if (isset($frame['args'])) {
                    $args = array();
                    foreach ($frame['args'] as $arg) {
                        if (is_string($arg)) {
                            $args[] = "'" . $arg . "'";
                        } elseif (is_array($arg)) {
                            $args[] = "Array";
                        } elseif (is_null($arg)) {
                            $args[] = 'NULL';
                        } elseif (is_bool($arg)) {
                            $args[] = ($arg) ? "true" : "false";
                        } elseif (is_object($arg)) {
                            $args[] = get_class($arg);
                        } elseif (is_resource($arg)) {
                            $args[] = get_resource_type($arg);
                        } else {
                            $args[] = $arg;
                        }
                    }
                    $args = join(", ", $args);
                }
                $current_file = "[internal function]";
                if (isset($frame['file'])) {
                    $current_file = $frame['file'];
                }
                $current_line = "";
                if (isset($frame['line'])) {
                    $current_line = $frame['line'];
                }
                $rtn .= sprintf("#%s %s(%s): %s(%s)\n",
                    $count,
                    $current_file,
                    $current_line,
                    $frame['function'],
                    $args);
                $count++;
            }
        } catch (\Exception $ex) {
            $rtn = $exception->getTraceAsString();
        }
        return $rtn;
    }

    /**
     * 将数组按键值由低到高排序（包含数组内部数据）
     * @param array $array
     */
    public static function arraySort(&$array)
    {
        if (!is_array($array)) {
            return;
        }

        ksort($array);
        foreach ($array as $key => &$value) {
            if (is_object($value)) {
                $value = (array)$value;
            }
            if (is_array($value)) {
                self::arraySort($value);
            }
        }
    }

    /**
     * 数组转换为对象（包含数组内数组）
     * @param array $array
     * @return mixed
     */
    public static function arrayToObject($array)
    {
        if (is_array($array)) {
            $obj = new \stdClass();
            foreach ($array as $key => $val) {
                $obj->$key = $val;
            }
        } else {
            $obj = $array;
        }
        return $obj;
    }

    /**
     * 对象转换为数组（包含对象内的对象）
     * @param mixed $object
     * @return array
     */
    public static function objectToArray($object)
    {
        $array = null;
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        } else {
            $array = $object;
        }
        return $array;
    }

    /**
     * 验证date是否为时间格式
     * @param $date
     * @return bool
     */
    public static function checkDateIsValid($date)
    {
        if (strtotime($date)) {
            return true;
        }

        return false;

//        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}.\d{3}$/', $date)) {
//            return false;
//        }
//        return true;
    }

    /**
     * 转换datetime格式
     * @param string $datetime_str
     * @param string $format
     * @return false|string
     */
    public static function getDatetimeFormat($datetime_str, $format = 'Y-m-d H:i:s')
    {
        if ($datetime_str === null) {
            return '';
        }
        return date($format, strtotime($datetime_str));
    }

    /**
     * @param $type
     * @return string
     * @deprecated 替换方法 Common::getDateTypeValueString
     */
    public static function getDateStr($type)
    {
        switch ($type) {
            case 0:
                return date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y'))) . ' 到 ' . date('Y-m-d', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
            case 1:
                $yesterday = date('d') - 1;
                return date('Y-m-d', mktime(0, 0, 0, date('m'), $yesterday, date('Y'))) . ' 到 ' . date('Y-m-d', mktime(23, 59, 59, date('m'), $yesterday, date('Y')));
            case 2:
                $timestamp = time();
                return date('Y-m-d', strtotime(date('Y-m-d', strtotime("this week Monday", $timestamp)))) . ' 到 ' . date('Y-m-d', strtotime(date('Y-m-d', strtotime("this week Sunday", $timestamp))) + 24 * 3600 - 1);
            case 3:
                return date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))) . ' 到 ' . date('Y-m-d',
                        mktime(23, 59, 59, date('m'), date('t'), date('Y')));
            case 4:
                $season = ceil((date('n')) / 3);
                return date('Y-m-d', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y'))) . ' 到 ' . date('Y-m-d', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date('Y'))), date('Y')));

            case 5:
                return date('Y-m-d', mktime(0, 0, 0, 1, 1, date('Y'))) . ' 到 ' . date('Y-m-d', mktime(23, 59, 59, 12, 31, date('Y')));
        }
    }

    /**
     * @param $type
     * @return array
     * @deprecated 使用Common::getDateTypeValues
     */
    public static function getBeginDateToEndDate($type)
    {
        switch ($type) {
            case 0:
                return array(date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y'))),
                    date('Y-m-d', mktime(23, 59, 59, date('m'), date('d'), date('Y')))
                );
            case 1:
                $yesterday = date('d') - 1;
                return array(date('Y-m-d', mktime(0, 0, 0, date('m'), $yesterday, date('Y'))), date('Y-m-d', mktime(23, 59, 59, date('m'), $yesterday, date('Y'))));
            case 2:
                $timestamp = time();
                return array(date('Y-m-d', strtotime(date('Y-m-d', strtotime("this week Monday", $timestamp)))), date('Y-m-d', strtotime(date('Y-m-d', strtotime("this week Sunday", $timestamp))) + 24 * 3600 - 1));
            case 3:
                return array(date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))), date('Y-m-d',
                    mktime(23, 59, 59, date('m'), date('t'), date('Y'))));
            case 4:
                $season = ceil((date('n')) / 3);
                return array(date('Y-m-d', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y'))), date('Y-m-d', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date('Y'))), date('Y'))));

            case 5:
                return array(date('Y-m-d', mktime(0, 0, 0, 1, 1, date('Y'))), date('Y-m-d', mktime(23, 59, 59, 12, 31, date('Y'))));
        }
    }

    /**
     * @param $data 一维数组数据源
     * @return mixed
     * @deprecated
     * description：入库之前设置部分默认值 *针对所有表*
     * author：wanghua
     * action：
     */
    public static function setDataDefaultValue($data)
    {

//        $user = Manager::getCurrentManager();
        if (isset($data['id']) && $data['id'] != '') {
//            $data['modify_by_league_id'] = $user['system_modify_by_league_id'];
//            $data['modify_by'] = $user['id'];
            $data['modify_by_league_id'] = Manager::getCurrentDataModifyByLeagueId();
            $data['modify_by'] = Manager::getCurrentManagerId();
        } else {
            $data['id'] = Tools::uuid();
            $data['is_local'] = 1;//1本地数据，0中控数据
//            $data['create_by'] = $user['id'];
//            $data['league_id'] = $user['system_league_id'];
//            $data['league_code_tree'] = $user['system_league_code_tree'];
//            $data['create_by_league_id'] = $user['system_create_by_league_id'];
//            $data['modify_by_league_id'] = $user['system_modify_by_league_id'];//新增时也默认有值（已确认）
            $data['create_by'] = Manager::getCurrentManagerId();
            $data['league_id'] = Manager::getCurrentDataLeagueId();
            $data['league_code_tree'] = Manager::getCurrentDataLeagueCodeTree();
            $data['create_by_league_id'] = Manager::getCurrentDataCreateByLeagueId();
            $data['modify_by_league_id'] = Manager::getCurrentDataModifyByLeagueId();
        }
        return $data;
    }


    /**
     * 将二维数组中指定的两列的【值】，转变为key=>value形态返回
     * 例如：
     * [
     *     ['id'=>'xxxxxxxxx', 'name'=>'A'],
     *     ['id'=>'yyyyyyyyy', 'name'=>'B']
     * ]
     * 转换为['xxxxxxxxx'=>'A', 'yyyyyyyyy'=>'B']
     * @param array $data 二位数据数据集
     * @param string $key1 转换后，作为key的列
     * @param string $key2 转换后，作为value的列
     * @return array
     */
    public static function array2ToKeyValueArray($data, $key1, $key2)
    {
        $arr1 = array_column($data, $key1);
        $arr2 = array_column($data, $key2);
        $tmp = [];
        foreach ($arr1 as $k => $v) {
            $tmp[$v] = $arr2[$k];
        }
        return $tmp;
    }

    public static function arrayKeyValueToString($arr, $split = '^^')
    {
        $keys = array_keys($arr);
        $values = array_values($arr);
        $str = '';
        foreach ($keys as $k => $key) {
            $str .= "{$key}=>{$values[$k]}{$split}";
        }
        return trim($str, '^^');
    }



    /**
     * 将二维数组中的某一列数值，处理为字符串数组处理为:  "a","b","c","d",...
     * 多用于转换以后，用于sql中的in查询
     * @param mixed $data 二维数组
     * @param string $field 要处理的字段名
     * @param string $spliter
     * @param string $char
     * @return string
     */
    public static function array2ToString($data, $field, $spliter = ',', $char = '\'')
    {
        if (empty($data)) return '';
        $arr = array_unique(array_column($data, $field));
        $str = '';
        foreach ($arr as $k => $v) {
            $str .= "{$spliter}{$char}{$v}{$char}";
        }
        return ltrim($str, $spliter);
//        return substr($str, 1);
    }

    /**
     * 将一位数组处理为字符串:  "a","b","c","d",...
     * author：wh
     * action：
     * @param array $arr 一维数组
     * @param string $spliter
     * @param string $char
     * @return string
     */
    public static function arrayToString($arr, $spliter = ',', $char = '\'')
    {
        if (empty($arr)) return '';
        $str = '';
        foreach ($arr as $v) {
//            $str .= ',"' . $v . '"';
            $str .= "{$spliter}{$char}{$v}{$char}";
        }
        return ltrim(substr($str, 1));
    }

    /**
     * 将"xxxx,yyy,zzz,xxxx"形态的字符串，去重
     * @param $str
     * @return string
     */
    public static function strUnique($str)
    {
        $tmp_arr = explode(',', $str);
        $arr = array_unique($tmp_arr);
        $str = implode(',', $arr);
        return $str;
    }



    public static function getQRCode($url)
    {
        return \QRcode::png($url);
    }

    /**
     * @param $date_type
     * @return bool|mixed
     * 使用方法：
     * $res = Tools::getDateByDateType(5);//返回 ['start_time'=>'2019-3-01', 'end_time'=>'2019-6-01']
     * 查询示例：
     * select * from table where create_time>=$res['start_time'] and create_time<$res['end_time']
     * @deprecated 使用Common::getDateTypeValues替换
     * description：根据 -1 到 6的7种时间类型获取开始时间和结束时间
     * 注：如有其它时间段查询需求，可联系我增加
     * author：wh
     */
    public static function getDateByDateType($date_type, $start_time = '', $end_time = '')
    {
        if ($start_time == '' || $start_time == null) $start_time = '1970-01-01';
        if ($end_time == '' || $end_time == null) $end_time = '2050-01-01';

        //处理季度 start
        $current_quarter = 1 * ceil(date('n') / 3);//当前第几季度
        $quarter = [
            1 => [1, 2, 3],//春
            2 => [4, 5, 6],//夏
            3 => [7, 8, 9],//秋
            4 => [10, 11, 12],//冬
        ];
        $quarter_start = date('Y') . '-' . $quarter[$current_quarter][0] . '-01';

        if ($current_quarter == 4) {
            $quarter_end = date('Y', strtotime('+1 year')) . '-01' . '-01';
        } else {
            $quarter_end = date('Y') . '-' . ($quarter[$current_quarter][2] + 1) . '-01';
        }
        //处理季度 end

        $date_type_arr = [
            //'全部',//这里默认查询n年
            -1 => [
                'start_time' => (1 * date('Y') - 30) . '-01-01',
                'end_time' => 1 + date('Y') . '-01-01',
            ],
            //'昨天',
            1 => [
                'start_time' => date('Y-m-d', strtotime('-1 day')),
                'end_time' => date('Y-m-d'),
            ],
            //'今天',
            2 => [
                'start_time' => date('Y-m-d'),
                'end_time' => date('Y-m-d', strtotime('+1 day')),
            ],
            //'本周',
            3 => [
                'start_time' => date('Y-m-d', (time() - ((date('w', time()) == 0 ? 7 : date('w', time())) - 1) * 24 * 3600)), //w为星期几的数字形式,这里0为周日;,
                'end_time' => date('Y-m-d', (time() - ((date('w', time()) == 0 ? 7 : date('w', time())) - 1) * 24 * 3600) + 7 * 86400),
            ],
            //'本月',
            4 => [
                'start_time' => date('Y-m') . '-01',
                'end_time' => date('Y-m', strtotime('+1 month')) . '-01',
            ],
            //'本季',
            5 => [
                'start_time' => $quarter_start,
                'end_time' => $quarter_end,
            ],
            //'本年',
            6 => [
                'start_time' => date('Y') . '-01-01',
                'end_time' => 1 + date('Y') . '-01-01',
            ],
            //7 自定义
            7 => [
                'start_time' => $start_time,
                'end_time' => $end_time,
            ],
            //上周
            8 => [
                'start_time' => date('Y-m-d', (time() - ((date('w', time()) == 0 ? 7 : date('w', time())) - 1) * 24 * 3600) - 7 * 86400),
                'end_time' => date('Y-m-d', (time() - ((date('w', time()) == 0 ? 7 : date('w', time())) - 1) * 24 * 3600)),
            ],
            //上月
            9 => [
                'start_time' => date('Y-m', strtotime('-1 month')) . '-01',
                'end_time' => date('Y-m') . '-01',
            ],
            //去年
            10 => [
                'start_time' => 1 * date('Y') - 1 . '-01-01',
                'end_time' => date('Y') . '-01-01',
            ],
        ];

        //处理
        if (empty($date_type_arr[$date_type])) {
            return false;
        } else {
            return ['start_time' => $date_type_arr[$date_type]['start_time'], 'end_time' => $date_type_arr[$date_type]['end_time']];
        }
    }

    /**
     * 数字格式化（固定保留2位小数，四舍五入）
     * @param $number
     * @return string
     */
    public static function numberFormatForTowPoint($number)
    {
        if (!is_numeric($number)) {
            $number = 0;
        }
        return number_format($number, '2', '.', '');
    }

    /**
     * 数字格式化（最多保留2位小数，四舍五入）
     * @param $number
     * @return string
     */
    public static function numberFormatForMostTowPoint($number)
    {
        if (!is_numeric($number)) {
            $number = 0;
        }
        return floatval(number_format($number, '2', '.', ''));
    }

    /**
     * 数字格式化（至少保留2位小数）
     * @param $number
     * @return string
     */
    public static function numberFormatForLeastTowPoint($number)
    {
        if (!is_numeric($number)) {
            $number = 0;
        }

        if (strstr($number, '.') == true) {
            $tmp_arr = explode('.', $number);
            $left_str = $tmp_arr[0];
            $right_tmp_str = $tmp_arr[1];
            $right_str = rtrim($right_tmp_str, '0');
            if (strlen($right_str) > 2) {
                return $left_str . '.' . $right_str;
            }
        }
        return number_format($number, '2', '.', '');
    }

    /**
     * 数字格式化（至少保留2位小数）（转换浮点型数字）
     * @param $number
     * @return string
     */
    public static function numberFormatForLeastTowPointFloat($number)
    {
        return floatval(self::numberFormatForLeastTowPoint($number));
    }

    /**
     * 数字格式化（去掉数字后所有的0）
     * @param $number
     * @return string
     */
    public static function numberFormatForNoZero($number)
    {
        if (!is_numeric($number)) {
            $number = 0;
        }
        return floatval($number);
    }

    /**
     * 数字格式化（只保留整数）
     * @param $number
     * @return string
     */
    public static function numberFormatForInteger($number)
    {
        if (!is_numeric($number)) {
            $number = 0;
        }
        return intval($number);
    }

    /**
     * 数字格式化（至少保留2位小数）
     * @param $number
     * @return string
     */
    public static function numberFormatForLeastEmpty($number)
    {
        if ($number == '' || $number == null) {
            return '';
        }
        return self::numberFormatForLeastTowPoint($number);
    }

    /**
     * 检查param是否为空
     * @param $param
     * @return bool
     */
    public static function isEmpty($param)
    {
        if ($param === 0 || $param === '0') {
            return false;//不为空
        }
        return empty($param);
    }

    /**
     * 下载文件 浏览器下载
     * @param $url
     * @param string $save_dir
     * @param $file_name
     * @return bool|string
     */
    public static function downloadOnlineFile($url, $save_dir = '', $file_name)
    {
        if (trim($save_dir) == '') {
            $save_dir = './';
        }
        if (0 !== strrpos($save_dir, '/')) {
            $save_dir .= '/';
        }
        //创建保存目录
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return false;
        }
        $pic_local = $save_dir . $file_name;

        ob_start(); //打开输出
        readfile($url); //输出文件
        $ob = ob_get_contents(); //得到浏览器输出
        ob_end_clean(); //清除输出并关闭
        file_put_contents($pic_local, $ob);

        return $pic_local;
    }

    /**
     * 获取访问客户端真实ip
     */
    public static function getRequestIp()
    {
        $requestIp = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $requestIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $requestIp;
    }

    /**
     * 将数组组装为url格式
     * @param string $base_url
     * @param $array
     * @return string
     */
    public static function generateParamsUrl($base_url, $array)
    {
        $buff = "";
        foreach ($array as $k => $v) {
            if (strpos($buff, '?') === false) {
                $buff .= "?" . $k . "=" . $v;
            } else {
                $buff .= "&" . $k . "=" . $v;
            }
        }
        $url = $base_url . $buff;
        return $url;
    }

    /**
     * 求两个日期之间相差的天数
     * @param string $day1
     * @param string $day2
     * @return number
     */
    public static function diffBetweenTwoDays($day1, $day2 = null)
    {
        $second1 = strtotime($day1);
        $second2 = $day2 ? strtotime($day2) : time();
        return ($second1 - $second2) / 86400;
    }

    /**
     * 二维数组冒泡排序
     * @param $array
     * @param $field
     * @return mixed
     */
    public static function bubbleSort2DArray($array, $field)
    {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = $i; $j < count($array); $j++) {
                if ($array[$i][$field] > $array[$j][$field]) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }
}