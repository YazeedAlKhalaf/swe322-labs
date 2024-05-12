<?php
function ClassCard(Clazz $class)
{
?>
    <div class="bg-gray-100 p-4 rounded-lg mb-4 flex flex-col justify-between">
        <div>
            <h2 class="text-xl font-semibold"><?php echo $class->name ?></h2>
            <h3 class="text-gray-700"><?php echo $class->description ?></h3>
        </div>
        <a href="<?php echo "/dashboard/class?id=" . $class->id ?>" class="text-red-500">View Class</a>
    </div>
<?php
}
?>