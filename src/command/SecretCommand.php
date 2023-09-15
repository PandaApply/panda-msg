<?php


namespace panda\msg\command;

use think\console\Input;
use think\console\Output;
use think\facade\App;

class SecretCommand extends \think\console\Command
{
    public function configure()
    {
        $this->setName('panda:create')
            ->setDescription('create workman files');
    }

    public function execute(Input $input, Output $output)
    {
        // 创建workman工作目录----覆盖操作
        // 源目录
        $sourceDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'workman' . DIRECTORY_SEPARATOR;
        // 目标目录
        $targetDir =app()->getAppPath() . 'common' . DIRECTORY_SEPARATOR . 'workman'. DIRECTORY_SEPARATOR;
        // 打开目标目录
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        // 复制目录中的文件
        if ($handle = opendir($sourceDir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    // 拼接源文件路径和目标文件路径
                    $sourceFile = $sourceDir . $file;
                    $targetFile = $targetDir . $file;
                    // 检查目标文件是否存在，存在则删除
                    if (file_exists($targetFile)) {
                        unlink($targetFile);
                    }
                    // 复制文件
                    if (copy($sourceFile, $targetFile)) {
                        $output->writeln('创建配置文件成功:' . $file);
                    } else {
                        $output->writeln('创建配置文件失败:' . $file);
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * 递归创建目录
     * @param string $dir 要创建的目录路径
     * @param int $mode 目录权限（默认为0777，表示最大权限）
     * @return bool 创建成功返回true，否则返回false
     */
    public function recursiveMkdir(string $dir, int $mode = 0777)
    {
        if (is_dir($dir) || mkdir($dir, $mode, true)) {
            return true;
        }
        if (!$this->recursiveMkdir(dirname($dir), $mode)) {
            return false;
        }
        return mkdir($dir, $mode);
    }

    public function createConfig($output)
    {
        $configFilePath = app()->getAppPath() . '..' . DIRECTORY_SEPARATOR . 'config'
            . DIRECTORY_SEPARATOR . 'jwt.php';

        if (!is_file($configFilePath)) {
            $res = copy(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR
                . 'config.php', $configFilePath);

            if ($res) {
                $output->writeln('Create config file success:' . $configFilePath);
            } else {
                $output->writeln('Create config file error');
                return;
            }
        }

        if (str_starts_with(\think\App::VERSION, '6.')) {
            $config = file_get_contents($configFilePath);
            $config = str_replace('Tp5', 'Tp6', $config);
            file_put_contents($configFilePath, $config);
        }
    }
}
