<?php

namespace Base64ToFile\Model\Behavior;

use ArrayObject;
use Base64ToFile\Exceptions\Base64Exception;
use Base64ToFile\Exceptions\NoFilenameException;
use Cake\Database\Exception;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Laminas\Diactoros\UploadedFile;

/**
 * Base64ToFile behavior
 */
class Base64ToFileBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'field' => 'file',

    ];


    public function __construct(Table $table, array $config = []) {
        parent::__construct($table, $config);
        $this->_table = $table;
    }


    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['file']) && $data['file'] != "") {
            $this->checkFieldForBase64String($data);
            $decodedImageFile = base64_decode(explode(',', $data['file'])[1]);
            $fileObject = new File(TMP . 'uploads' . DS . time() . "_" . $data['filename'], true);
            $fileObject->write($decodedImageFile);
            $param = explode('/', $fileObject->mime());
            if (isset($data['filename'])) {
                $filename = $data['filename'];
            } else {
                throw new NoFilenameException();
            }
            $data['filename'] = new UploadedFile(
                $fileObject->path,
                $fileObject->size(),
                UPLOAD_ERR_OK,
                $filename . '.' . $param[1],
                $fileObject->mime()
            );
        }
    }


    private function checkFieldForBase64String(ArrayObject $data)
    {
        $fieldKey = $this->_config['field'];
        $fieldvalue = $data->getArrayCopy()[$fieldKey];
        if (strpos($fieldvalue, ';base64') == false) {
            throw new Base64Exception();
        }
    }
}
