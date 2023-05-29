import { useState, useEffect } from "react";
import "./Pagination.scss";
import SvgIcon from "./SvgIcon";

export default function Pagination({
  maxItem,
  itemPerPage,
  currentPage,
  changePage,
}) {
  const maxPage = maxItem / itemPerPage;

  const [startIndex, setStart] = useState();
  const [endIndex, setEnd] = useState();

  const [startNav, setStartNav] = useState(false);
  const [endNav, setEndNav] = useState(false);

  const [pageList, setPageList] = useState([]);

  useEffect(() => {
    const cur = currentPage;
    const max = maxPage;
    let arr = [];
    if (max <= 6) {
      // arr = []
      for (var i = 1; i <= max; i++) arr.push(i);
      setStartNav(false);
      setEndNav(false);
    } else {
      if (cur <= 3) {
        arr = [1, 2, 3, 4];
        setStartNav(false);
        setEndNav(true);
      } else if (cur + 2 >= max) {
        arr = [max - 3, max - 2, max - 1, max];
        setStartNav(true);
        setEndNav(false);
      } else {
        arr = [cur - 1, cur, cur + 1];
        setStartNav(true);
        setEndNav(true);
      }
    }
    setPageList(arr);
    setStart((currentPage - 1) * itemPerPage);
    setEnd(
      currentPage * itemPerPage > maxItem ? maxItem : currentPage * itemPerPage
    );
  }, [currentPage, maxItem]);

  return (
    <>
      {maxItem ? (
        <div className="pagination">
          <div className="btn-list">
            <button
              disabled={currentPage === 1}
              onClick={() => changePage(currentPage - 1)}
            >
              <SvgIcon name="left-arrow" width={14} height={14} />

            </button>
            {pageList[0] !== 1 ? (
              <button onClick={() => changePage(1)}>1</button>
            ) : (
              ""
            )}
            {startNav ? <div>...</div> : ""}
            {pageList.map((page) => {
              return (
                <button key={`page${page}`} onClick={() => changePage(page)}>
                  {page === currentPage ? <b>{page}</b> : page}
                </button>
              );
            })}
            {endNav ? <div>...</div> : ""}
            {pageList[pageList.length - 1] !== maxPage ? (
              <button onClick={() => changePage(maxPage)}>{maxPage}</button>
            ) : (
              ""
            )}
            <button
              disabled={currentPage === maxPage}
              onClick={() => changePage(currentPage + 1)}
            >
              <SvgIcon name="right-arrow" width={14} height={14} />
            </button>
          </div>
          <div>
            {startIndex} - {endIndex} を表示
          </div>
        </div>
      ) : (
        <></>
      )}
    </>
  );
}
