<?php

namespace Base64ToFile\Model\Behavior;

use ArrayObject;
use Cake\Database\Exception;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

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
        $this->checkFieldForBase64String($data);
        $decodedImageFile = base64_decode(explode(',', $data['file'])[1]);
        $fileObject = new File(TMP . DS . 'uploads');
        $fileObject->write($decodedImageFile);
        $param = explode('/', $fileObject->mime());
        $filename = $data['filename'];
        $data['filename'] = [
            'name' => $filename . '.' . $param[1],
            'type' => $fileObject->mime(),
            'tmp_name' => $fileObject->path,
            'error' => 0,
            'size' => $fileObject->size()
        ];
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
