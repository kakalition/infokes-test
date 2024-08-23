import { Table, TableBody, TableCell, TableColumn, TableHeader, TableRow} from '@nextui-org/react';

import "react-contexify/dist/ReactContexify.css";
import _ from 'lodash';

import {DndContext} from '@dnd-kit/core';
import Draggable from './dnd/draggable';
import IconFolder from './icons/folder';
import IconFile from './icons/file';
import Droppable from './dnd/droppable';

export default function FileTable({onDragEnd, rightPaneFiles, onItemDoubleClicked, onContextMenu}) {
  return (
    <DndContext onDragEnd={onDragEnd}>
      <Table aria-label="Current folders" className='w-full'>
        <TableHeader>
          <TableColumn>NAME</TableColumn>
          <TableColumn width={30}>TYPE</TableColumn>
          <TableColumn width={200}>CREATED AT</TableColumn>
          <TableColumn width={200}>UPDATED AT</TableColumn>
        </TableHeader>
        <TableBody items={rightPaneFiles} emptyContent={"No rows to display."}>
          {(item) => {
            const nameElementContent = (
              <Draggable id={item.id} className='flex flex-row gap-2'>
                {item.type == "FOLDER" ? <IconFolder className="size-6 flex-none" /> : <IconFile className="size-6 flex-none" />} 
                <p>{item.name}</p>
              </Draggable>
            )

            const nameElement = item.type == "FILE"
              ? nameElementContent
              : <Droppable id={item.id}>{nameElementContent}</Droppable>

            return (
              <TableRow key={item.id} 
                className='cursor-pointer select-none transition hover:bg-gray-100' 
                onDoubleClick={() => onItemDoubleClicked(item)} 
                onContextMenu={(e) => onContextMenu({event: e, props: item})}
              >
                <TableCell>
                  {nameElement}
                </TableCell>
                <TableCell>{_.startCase(_.toLower(item.type))}</TableCell>
                <TableCell>{item.created_at}</TableCell>
                <TableCell>{item.updated_at}</TableCell>
              </TableRow>
            )
          }}
        </TableBody>
      </Table>
    </DndContext>
  )
}