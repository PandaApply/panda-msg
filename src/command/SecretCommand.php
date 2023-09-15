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
        $targetDir = app()->getAppPath() . 'common' . DIRECTORY_SEPARATOR . 'workman' . DIRECTORY_SEPARATOR;
        $this->createConfig($sourceDir, $targetDir, $output);

        // 创建workman启动文件
        // 源目录
        $sourceDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'start' . DIRECTORY_SEPARATOR;
        // 目标目录
        $targetDir = app()->getAppPath() . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
        $this->createConfig($sourceDir, $targetDir, $output);
    }


    /**
     * 创建配置文件
     * @param $sourceDir
     * @param $targetDir
     * @return void
     */
    public function createConfig($sourceDir, $targetDir, $output)
    {
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
}
