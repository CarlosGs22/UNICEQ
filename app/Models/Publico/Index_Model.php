<?php

namespace App\Models\Publico;

use CodeIgniter\Model;

class Index_Model extends Model
{
    public $table = 'area';

    public $primaryKey = 'idarea';

    /*public function _obtenerArea()
    {
        return $this->select('idarea,area,valor,(SELECT AVG(progreso) FROM indicador  WHERE indicador.idarea = area.idarea) as promedio')->findAll();
    }*/

    public function _obtenerArea()
    {
        $sql = "SELECT a.idarea,
    a.area,
    count(mt.id_indicador) as metas_cum,
    (
        SELECT count(ind.idindicador) as metas_por
        FROM uniceqed_ma2.area ar
            inner join indicador ind on ind.idarea = ar.idarea
        where ar.idarea = a.idarea
    ) as metas_por,
    ((count(mt.id_indicador) / (
        SELECT count(ind.idindicador) as metas_por
        FROM uniceqed_ma2.area ar
            inner join indicador ind on ind.idarea = ar.idarea
        where ar.idarea = a.idarea
    ) * 100) * a.valor)/100 as promedio,a.valor
FROM uniceqed_ma2.meta_mensual mt
    inner join uniceqed_ma2.indicador i on i.idindicador = mt.id_indicador
    inner join uniceqed_ma2.area a on i.idarea = a.idarea
where mt.alcanzado > 0
    and mt.alcanzado >= mt.planeado
    and mt.estado = 1
group by a.idarea";
        $query = $this->query($sql);
        return $query->getResult();
    }


    public function _obtenerPromedio()
    {
        $sql = "SELECT a.idarea,
        a.area,
        count(mt.id_indicador) as metas_cum,
        (
            SELECT count(ind.idindicador) as metas_por
            FROM uniceqed_ma2.area ar
                inner join indicador ind on ind.idarea = ar.idarea
            where ar.idarea = a.idarea and ind.estado = 1
        ) as metas_por,
        ((count(mt.id_indicador) / (
            SELECT count(ind.idindicador) as metas_por
            FROM uniceqed_ma2.area ar
                inner join indicador ind on ind.idarea = ar.idarea
            where ar.idarea = a.idarea and ind.estado = 1
        ) * 100) * a.valor)/100 as promedio,a.valor
    FROM uniceqed_ma2.meta_mensual mt
        inner join uniceqed_ma2.indicador i on i.idindicador = mt.id_indicador
        inner join uniceqed_ma2.area a on i.idarea = a.idarea
    where mt.alcanzado > 0
        and mt.alcanzado >= mt.planeado
        and mt.estado = 1 and i.estado = 1
    group by a.idarea";
        $query = $this->query($sql);
        return $query->getResult();
    }


}
