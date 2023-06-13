<?php

namespace Fhtechnikum\Uebung34\Views;

class HTMLTableView implements ViewInterface
{

    public function display($data)
    {
        echo "<table border='1'>";
        $first = true;
        foreach($data as $name => $entry) {
            if($first) {
                echo "<thead><tr>";
                echo "<th>" . $name . "</th>";
                echo "</tr></thead>";
                $first = false;
            }

            if($name == "products"){
                echo "<td>";
                $this->displayProductsList($entry);
                echo "</td>";
            } else {
                echo "<td>"  . $entry . "</td>";
            }
        }
        echo "</table>";

    }

    private function displayProductsList($productList)
    {
        echo "<ul>";

        foreach($productList as $item) {

            echo "<li>" . $item->name ."</li>";
        }

        echo "</ul>";
    }
}