<?php

function similarity_distance($matrix, $person1, $person2)
{
    $similary = array();
    $sum = 0;
    foreach($matrix[$person1] as $key=>$value)
    {
        if (array_key_exists($key, $matrix[$person2]))
        {
            $similar[$key] = 1;
        }

        if($similar = 0)
        {
            return 0;
        }

        foreach ($matrix[$person1] as $key=>$value)
        {
            if (array_key_exists($key,$matrix[$person2]))
            {
                $sum = $sum + pow($value - $matrix[$person2][$key], 2);
            }
        }
    return 1/(1+sqrt($sum)); // difference become [0:1]
    }
}




function getRecommendation($matrix1, $weight1, $matrix2, $weight2, $matrix3, $weight3, $matrix4, $weight4, $person)
{
    $simTotal = array();
    foreach ($matrix1 as $otherPerson=>$value)
    {
        if ($otherPerson != $person)
        {
            $sim1 = similarity_distance($matrix1, $person, $otherPerson) * $weight1;
            //var_dump($sim);
            $simTotal[$otherPerson] = $sim1;
        }
    }

    foreach ($matrix2 as $otherPerson=>$value)
    {
        if ($otherPerson != $person)
        {
            $sim2 = similarity_distance($matrix2, $person, $otherPerson) * $weight2;
            //var_dump($sim);
            $simTotal[$otherPerson] = $simTotal[$otherPerson] + $sim2;
        }
    }

    foreach ($matrix3 as $otherPerson=>$value)
    {
        if ($otherPerson != $person)
        {
            $sim3 = similarity_distance($matrix3, $person, $otherPerson) * $weight3;
            //var_dump($sim);
            $simTotal[$otherPerson] = $simTotal[$otherPerson] + $sim3;
        }
    }

    foreach ($matrix4 as $otherPerson=>$value)
    {
        if ($otherPerson != $person)
        {
            $sim4 = similarity_distance($matrix4, $person, $otherPerson) * $weight4;
            //var_dump($sim);
            $simTotal[$otherPerson] = $simTotal[$otherPerson] + $sim4;
        }
    }


    //$recommended = array_keys($simTotal,max($simTotal));


    //print_r($recommended[0]); 
    //print_r($simTotal);
    return $simTotal; // return the most similar username
}


?>