<?php


/**
 * Skeleton subclass for representing a row from the 'screen' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Screen extends BaseScreen
{
    public function checkAlive()
    {
        exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->getIp())), $res, $rval);
        return $rval === 0;
    }

    public function magicBoot()
    {
        exec(sprintf('wakeonlan %s', escapeshellarg($this->getMac())), $res, $rval);
        return $rval === 0;
    }

    public function checkIn()
    {
        $this->setLastSeen(time())
            ->save();
    }

    public function getMachineFriendlyName()
    {
        return strtolower(url_title($this->getName()));
    }

    public function getRemote()
    {

        $path = realpath(dirname($_SERVER['SCRIPT_FILENAME']));
        $previewPath = 'assets/uploads/previews/';

        exec('vncsnapshot -passwd ' . $path . '/.vnc.pwd ' . $this->getIp() . ' ' . $path . DIRECTORY_SEPARATOR . $previewPath . $this->getMachineFriendlyName() . '.jpg', $res, $val);

        if (0 === $val) {
            return base_url($previewPath . $this->getMachineFriendlyName() . '.jpg');
        } else {
            return NULL;
        }
    }
}
