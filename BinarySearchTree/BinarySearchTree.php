<?php
/**
 * Created by PhpStorm.
 * User: matthewmanuel
 * Date: 27/05/15
 * Time: 10:56 PM
 */

// $huh = new FakeNode(1, new FakeNode(4,3), new FakeNode(1,5));

// $existingTree = array(
//     'value'=> 1,
//     'l'=> array (
//         'value'=> 5,
//         'l'=> array (
//             'value'=> 5),
//         'r'=> array (
//             'value'=> 10,
//             'l'=> array (
//                 'value'=> 5,
//                 'l'=> array (
//                     'value'=> 10
//                     ),
//                 'r'=> array (
//                     'value'=> 11
//                     )
//                 )    
//             )
//         ),
//     'r' => array (
//         'value'=> 3
//         )
//     );

// print_r($existingTree);


$bst = new BinarySearchTree();
$array = [27, 14, 35, 10, 19, 31, 42 ];



//creates BST from array
foreach($array as &$arr) {
    echo "index ". $arr . "\n";
    $bst->AddLeaf($arr);
}


echo("Printing In Order"."\n");
$bst->PrintInOrder();
echo("Printing Pre Order"."\n");
$bst->PrintPreOrder();
echo("Printing Pre Order Count of Unique Values In Chain"."\n");
$bst->PreOrder_CountUniqueValue();
echo("Printing Post Order"."\n");
$bst->PrintPostOrder();

class Node {
    public $data, $left, $right = NULL;

    public function __construct($data = NULL) {
        $this->data = $data;
    }
}



class BinarySearchTree {

    private $rootNode = NULL;

    public function &CreateNode($data) {
        $node = new Node($data);
        return $node;
    }

    public function AddLeaf($data) {
        $this->AddNodePrivate($data, $this->rootNode); //Adds the initial root 
    }

    //currently allowing duplicates
    function AddNodePrivate($data, &$node) {
        
        //creates the rootNode
        if($this->rootNode === NULL) {
            $this->rootNode = $this->CreateNode($data);
        }
        else if ($data <= $node->data ) {
            if ($node->left !== NULL) { //Keep traversing the LeftChild recursively.
                $this->AddNodePrivate($data, $node->left);
            } else {
                $node->left = $this->CreateNode($data);
            }
        }
        else if( $data > $node->data ) {
            if( $node->right !== NULL ) { //Keep traversing the Rightchild recursively.
                $this->AddNodePrivate($data, $node->right);
            } else {
                $node->right = $this->CreateNode($data);
            }
        } else {
            // echo "Value already exists! \n";
        }
    }

    function PrintInOrderPrivate (Node &$node) {
        if($node == NULL ) {
            
            return;
        }

        if ($node->left != NULL) {
            $this->PrintInOrderPrivate($node->left);
        }

        echo $node->data . " ";

        if ($node->right != NULL) {
            $this->PrintInOrderPrivate($node->right);
        }

        echo " \n";
    
    }

    public $highestCount = 0;
    function PrintPreOrder_CountUniqueValues(Node &$node, &$tempCollection, &$currentCount) {
        if ($node == null) {
            return;
        }
        
        if(!array_key_exists($node->data, $tempCollection)) {
            $tempCollection[$node->data] = $node->data;

            print_r($tempCollection);   
            $currentCount++;
            print(" after ".$currentCount. " ");
        }

        echo $node->data . " ";

        if ($node->left != NULL) {
            $this->PrintPreOrder_CountUniqueValues($node->left, $tempCollection, $currentCount);
        }

        //remove left key
        if ($node->right != NULL) {
            $currentCount--;
            $this->PrintPreOrder_CountUniqueValues($node->right, $tempCollection, $currentCount);
        }

        echo " removing: ".$node->data. " \n";
        unset($tempCollection[$node->data]);

        //empty the array in the end.
        if($currentCount > $this->highestCount) {
            $this->highestCount = $currentCount;
        }
        print("hc:". $this->highestCount . "\n");

        // don't empt the array. just empty the key.
        // $tempCollection = array();
        $currentCount = 0;
    }

    function PrintPreOrderPrivate(Node &$node) {
        if ($node == null)
            return;
        
        echo $node->data . "\n";

        if ($node->left != NULL) {
            $this->PrintPreOrder_CountUniqueValues($node->left);
        }

        if ($node->right != NULL) {
            $this->PrintPreOrder_CountUniqueValues($node->right);
        }
    }

    function PrintPostOrderPrivate(Node &$node) {
        if ($node == null) {
            return;
        }

        if ($node->left != NULL) {
            $this->PrintPostOrderPrivate($node->left);
        }

        if ($node->right != NULL) {
            $this->PrintPostOrderPrivate($node->right);
        }

        echo $node->data ."\n";
    } 

    public function PrintInOrder() {
        $this->PrintInOrderPrivate($this->rootNode);
    }
    public function PrintPreOrder() {
        $this->PrintPreOrderPrivate($this->rootNode);  
    }

    public function PreOrder_CountUniqueValue(){
        $tempArray = array();
        $currentCount = 0;
        $this->PrintPreOrder_CountUniqueValues($this->rootNode, $this->$tempArray, $currentCount);
    }
    public function PrintPostOrder() {
        $this->PrintPostOrderPrivate($this->rootNode);
    }

}


