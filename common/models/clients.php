<?

namespace common\models;
 
use yii\db\ActiveRecord;
 
class Clients extends ActiveRecord
{
    public function getBonuses()

    {
        return $this->hasOne(Bonuses::className(), ['id' => 'bonus']);
    }
}