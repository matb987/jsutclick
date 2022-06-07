<?php

namespace App\Tables;

use App\Models\Order;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class OrderTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(Order::class)
            ->routes([
                'index'   => ['name' => 'order.index'],
                'create'  => ['name' => 'order.create'],
                'edit'    => ['name' => 'order.edit'],
                'destroy' => ['name' => 'order.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(Order $order) => [
                'data-confirm' => __('Are you sure you want to delete the entry :entry?', [
                    'entry' => $order->database_attribute,
                ]),
            ]);
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable();
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     */
    protected function resultLines(Table $table): void
    {
        //
    }
}
