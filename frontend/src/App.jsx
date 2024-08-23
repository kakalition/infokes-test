import { useEffect, useMemo, useState } from 'react';
import { useDisclosure, Image} from '@nextui-org/react';
import { Item, Menu, useContextMenu } from 'react-contexify';

import "react-contexify/dist/ReactContexify.css";
import _ from 'lodash';
import API from './api.js';
import toast, { Toaster } from 'react-hot-toast';

import ExploryImage from './assets/Explory.png';
import CustomBreadcrumbs from './components/custom_breadcrumbs.jsx';
import DeleteModal from './components/modals/delete_modal.jsx';
import RenameModal from './components/modals/rename_modal.jsx';
import NewModal from './components/modals/new_modal.jsx';
import LeftPane from './components/left_pane.jsx';
import FileTable from './components/file_table.jsx';
import FileTiles from './components/file_tiles.jsx';
import Square2X2 from './components/icons/square_2x2.jsx';
import ListBullet from './components/icons/list_bullet.jsx';

const BACKGROUND_ID = "background-id";
const FILE_ID = "file-id";

function App() {
  const api = new API();

  const [data, setData] = useState([]);
  const [rightPaneTargetId, setRightPaneTargetId] = useState(null);
  const [objectType, setObjectType] = useState("");
  const [contextId, setContextId] = useState("");
  const [parentId, setParentId] = useState("");
  const [inputValue, setInputValue] = useState("");
  const [cutCopyPasteObject, setCutCopyPasteObject] = useState(null);

  const [viewMode, setViewMode] = useState("TILE");

  async function fetchData() {
    api.getFolders(async (response) => {
      const data = await response.json()
      setData(data);
    });

    api.getFolderContent(rightPaneTargetId, async (response) => {
      const data = await response.json()
      setRawRightPaneFiles(data);
    });
  }

  useEffect(() => {
    fetchData();
  }, []);

  const {
    isOpen: isOpenNewObject, 
    onOpen: onOpenNewObject, 
    onOpenChange: onOpenChangeNewObject,
  } = useDisclosure();

  const {
    isOpen: isOpenRenameObject, 
    onOpen: onOpenRenameObject, 
    onOpenChange: onOpenChangeRenameObject,
  } = useDisclosure();

  const {
    isOpen: isOpenDeleteObject, 
    onOpen: onOpenDeleteObject, 
    onOpenChange: onOpenChangeDeleteObject,
  } = useDisclosure();

  const { show: _showBackgroundContext } = useContextMenu({ id: BACKGROUND_ID });
  const { show: _showFileContext } = useContextMenu({ id: FILE_ID });

  function newObjectContextHandler(data, type) {
    setObjectType(_.startCase(_.toLower(type)))
    setContextId(null);
    setInputValue("");

    onOpenNewObject()
  }

  function renameObjectContextHandler(data) {
    setObjectType(_.startCase(_.toLower(data.props.type)))
    setContextId(data.props.id);
    setInputValue(data.props.name);

    onOpenRenameObject()
  }

  function copyObjectContextHandler(data) {
    setObjectType(null)
    setContextId(null);
    setInputValue("");

    setCutCopyPasteObject({
      action: "COPY",
      data: data.props,
    })
  }

  function cutObjectContextHandler(data) {
    setObjectType(null)
    setContextId(null);
    setInputValue("");

    setCutCopyPasteObject({
      action: "CUT",
      data: data.props,
    })
  }

  async function pasteObjectContextHandler(data) {
    await api.pasteObject(cutCopyPasteObject.action, cutCopyPasteObject.data.id, data.props.id)
    setCutCopyPasteObject(null);

    toast.success("File pasted!");

    await fetchData();
  }

  function deleteObjectContextHandler(data) {
    setObjectType(_.startCase(_.toLower(data.props.type)))
    setContextId(data.props.id);

    onOpenDeleteObject()
  }

  function showBackgroundContext({event, props}) {
    event.stopPropagation();
    setParentId(props.id)

    _showBackgroundContext({event, props: props})
  }

  function showBackgroundFolderOnlyContext({event, props}) {
    event.stopPropagation();
    setParentId(null)

    _showBackgroundContext({event, props: props})
  }

  function showFileContext({event, props}) {
    event.stopPropagation();

    _showFileContext({event, props: props})
  }

  const [rawRightPaneFiles, setRawRightPaneFiles] = useState([]);
  useEffect(() => {
    if (rightPaneTargetId == null) {
      setRawRightPaneFiles([]);
      return;
    }

    api.getFolderContent(rightPaneTargetId)
      .then((data) => data.json())
      .then((data) => setRawRightPaneFiles(data))
  }, [rightPaneTargetId]);

  const rightPaneFiles = useMemo(() => { 
    const temp = rawRightPaneFiles.map((e) => {
      e.priority = e.type == "FOLDER" ? 2 : 1;
      return e;
    })

    temp.sort((a, b) => b.priority - a.priority || b.name - a.priority);

    return temp; 
  }, [rawRightPaneFiles]);

  async function createObjectAction(onClose) {
    let response;
    if (objectType.toUpperCase() == "FOLDER") {
      response = await api.createFolder(parentId, inputValue)
    } else {
      response = await api.createFile(parentId, inputValue)
    }

    if (response.ok) {
      await fetchData();

      toast.success(`${objectType} created!`);
      onClose();
      return;
    } 

    toast.error((await response.json()).errors.message);
  }

  async function renameObjectAction(onClose) {
    let response;
    if (objectType.toUpperCase() == "FOLDER") {
      response = await api.updateFolder(contextId, inputValue)
    } else {
      response = await api.updateFile(contextId, inputValue)
    }

    if (response.ok) {
      toast.success(`${objectType} renamed!`);
      await fetchData();
      onClose();

      return;
    } 

    toast.error((await response.json()).errors.message);
  }

  async function deleteObjectAction(onClose) {
    if (objectType.toUpperCase() == "FOLDER") {
      await api.deleteFolder(contextId)
    } else {
      await api.deleteFile(contextId)
    }

    toast.success(`${objectType} deleted!`);

    await fetchData();

    onClose();
  }

  function onObjectDoubleClicked(item) {
    if (item.type == "FILE") {
      return;
    }

    setRightPaneTargetId(item.id)
  }

  async function dragAndDropHandler(event) {
    if (!event?.active?.id || !event?.over?.id) {
      return;
    }

    if (event.active.id == event.over.id) {
      return;
    }

    await api.pasteObject("CUT", event.active.id, event.over.id)
    toast.success(`Object moved!`);
    await fetchData();
  }

  return (
    <>
      <Toaster />
      <div className='flex h-screen w-full flex-col overflow-y-hidden bg-gray-50'>
        <div className='flex h-16 w-full flex-none flex-row items-center border-b-2 border-b-gray-200 px-4'>
          <Image src={ExploryImage} className="mr-1 size-10" />
          <h1 className='text-xl font-medium'>Explory</h1>
        </div>
        <div className='flex size-full flex-row overflow-y-hidden'>
          <LeftPane 
            data={data}
            onBackgroundContextMenu={showBackgroundFolderOnlyContext}
            onItemContextMenu={showBackgroundContext}
            onRightPaneIdChange={setRightPaneTargetId}
            rightPaneId={rightPaneTargetId}
          />
          <div className='flex size-full flex-col overflow-y-scroll'>
            <div className='flex flex-row items-center justify-between pr-2 pt-2'>
              <CustomBreadcrumbs data={data} rightPaneId={rightPaneTargetId} onRightPaneIdChange={setRightPaneTargetId} />
              <div className='flex flex-row items-center gap-2'>
                <button type='button' 
                  onClick={() => setViewMode("TILE")}
                  className={`${viewMode == "TILE" ? "bg-gray-200" : ""} rounded-xl border-2 border-gray-200 p-2 transition hover:bg-gray-200`}
                >
                  <Square2X2 />
                </button>
                <button type='button' 
                  onClick={() => setViewMode("LIST")}
                  className={`${viewMode == "LIST" ? "bg-gray-200" : ""} rounded-xl border-2 border-gray-200 p-2 transition hover:bg-gray-200`}
                >
                  <ListBullet />
                </button>
              </div>
            </div>
            <div className='min-h-full w-full bg-gray-50 p-4' onContextMenu={(e) => showBackgroundContext({event: e, props: {id: rightPaneTargetId, parentId: rightPaneTargetId}})}>
              {
                viewMode == "LIST"
                  ? <FileTable 
                    onContextMenu={showFileContext}
                    onDragEnd={dragAndDropHandler}
                    onItemDoubleClicked={onObjectDoubleClicked}
                    rightPaneFiles={rightPaneFiles}
                  />
                  : <FileTiles 
                    onContextMenu={showFileContext}
                    onDragEnd={dragAndDropHandler}
                    onItemDoubleClicked={onObjectDoubleClicked}
                    rightPaneFiles={rightPaneFiles}
                  />
              }
            </div>
          </div>
        </div>
      </div>

      <Menu id={BACKGROUND_ID}>
        <Item onClick={(data) => newObjectContextHandler(data, "FOLDER")}>
          New Folder
        </Item>
        <Item onClick={(data) => newObjectContextHandler(data, "FILE")}>
          New File
        </Item>
        <Item hidden={() => cutCopyPasteObject == null} onClick={pasteObjectContextHandler}>
          Paste
        </Item>
      </Menu>

      <Menu id={FILE_ID}>
        <Item onClick={renameObjectContextHandler}>
          Rename
        </Item>
        <Item onClick={copyObjectContextHandler}>
          Copy
        </Item>
        <Item onClick={cutObjectContextHandler}>
          Cut
        </Item>
        <Item hidden={({props}) => {
          return cutCopyPasteObject == null || cutCopyPasteObject?.data?.id == props.id || props.type != "FOLDER";
        }} onClick={pasteObjectContextHandler}>
          Paste
        </Item>
        <Item onClick={deleteObjectContextHandler}>
          Delete
        </Item>
      </Menu>

      <NewModal 
        isOpen={isOpenNewObject} 
        onOpenChange={onOpenChangeNewObject} 
        objectType={objectType} 
        onAction={createObjectAction} 
        value={inputValue}
        onValueChange={setInputValue}
      />

      <RenameModal 
        isOpen={isOpenRenameObject} 
        onOpenChange={onOpenChangeRenameObject} 
        objectType={objectType} 
        onAction={renameObjectAction} 
        value={inputValue}
        onValueChange={setInputValue}
      />

      <DeleteModal 
        isOpen={isOpenDeleteObject} 
        onOpenChange={onOpenChangeDeleteObject} 
        objectType={objectType} 
        onAction={deleteObjectAction} 
      />
    </>
  )
}

export default App
