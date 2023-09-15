<?php

namespace panda\msg\util;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/15
 * Desc:文件相关操作
 */
class FileUtil
{
    /**
     * 递归创建目录
     * @param string $dir 要创建的目录路径
     * @param int $mode 目录权限（默认为0777，表示最大权限）
     * @return bool 创建成功返回true，否则返回false
     */
    public function recursiveMkdir(string $dir, int $mode = 0777): bool
    {
        if (is_dir($dir) || mkdir($dir, $mode, true)) {
            return true;
        }
        if (!$this->recursiveMkdir(dirname($dir), $mode)) {
            return false;
        }
        return mkdir($dir, $mode);
    }
}
